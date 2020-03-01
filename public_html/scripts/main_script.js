window.onload = display_workers();
var models_are_loaded = 0;
var VIDEO_RATIO = 35;
var faceMatcherisready=0;
var faceExpressionsCounter=0;
var exprCounter = 0;
var faceNotMatch = 0;
var FACE_NOT_MATCH_THRESHOLD = 8;
var randomExp = [];
var stop_stream = "";
var TIMEOUT_TIME = 60; // divide value by 10 to get time in secs...
var frames = "";
var currentWorkerId = "";

// Loading all Face Recognition/Detection/Expression Models
var MODELS_URL = "/models";
Promise.all([
  faceapi.nets.tinyFaceDetector.loadFromUri(MODELS_URL),
  faceapi.nets.faceLandmark68Net.loadFromUri(MODELS_URL),
  faceapi.nets.faceRecognitionNet.loadFromUri(MODELS_URL),
  faceapi.nets.faceExpressionNet.loadFromUri(MODELS_URL),
  faceapi.nets.ssdMobilenetv1.loadFromUri(MODELS_URL)
]).then(model_loaded => {models_are_loaded = 1;})


function markAttendanceJS(worker_id){
	currentWorkerId = worker_id;
	if(models_are_loaded){
		let video = document.getElementById(`video_${worker_id}`);
		startRecognition(worker_id);
		document.getElementById(`close_${worker_id}`).onclick=(video,frames)=>{
			frames = "";
			vidOff(video);
		}
		//////////////////////////////////////////////////////// set the video width here
		video.width = 9 * VIDEO_RATIO;
		video.height = 7 * VIDEO_RATIO;
		startVideo();
		
		function startVideo() {
  			navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia ;
  			if(navigator.getUserMedia){navigator.getUserMedia({video:true}, streamWebCam, throwError);}
  			function streamWebCam(stream){
    			video.srcObject = stream;
    			video.play();
  			}
  			function throwError(error){ alert(error.name); }
		}

		async function startRecognition(worker_id){
		  const labeledFaceDescriptors = await loadLabeledImages(worker_id);
		  randomExp = generateRandomExp();
		  // Indicate Expressions to make, here...
		  document.getElementById(`make_expr_${worker_id}`).innerHTML = "make: "+randomExp[0];
		  faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6);//////
		  faceMatcherisready=1;
		}

		video.addEventListener('playing', () => {
  			// console.log("Video is playing");
  			const displaySize = { width: video.width, height: video.height };
  			document.getElementById(`close_${worker_id}`).disabled = false;
  			frames = setInterval(async () => {
    			if(exprCounter==3){
      				// Worker PRESENT
			    	///////////////////////////////////////////////////////////////////////////////////
			    	var xhttp = new XMLHttpRequest();
			     	xhttp.onload = function(){  
				        let data = this.responseText;
				        if(data == "P"){
				          alert(`Worker ID ${worker_id} is Marked Present`);
				          display_workers();
				        }
				        else if(data == "Present marking Failed"){
				          alert(data);
				        }else{ alert("Invalid Request"); }
			        };
			      	xhttp.open("POST", "http://localhost/project/present.php");
			      	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			      	xhttp.send(`worker_id_present=${worker_id}`);
			      	////////////////////////////////////////////////////////////////////////////////////
			      	document.getElementById(`close_${worker_id}`).click();
			      	ResetAll(video,frames);
				}
    			const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceExpressions().withFaceDescriptors();
    			const resizedDetections = faceapi.resizeResults(detections, displaySize);
    			if(faceMatcherisready){
      				// faceMatcherisready += 1;
      				const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor));
      				/// Recognised person ka name yaha se print hora hai
			      	try{
			        	printDetectedPerson(results[0].toString(),worker_id,video,frames);
			        	detectedPerson = results[0].toString();
			      	}catch{
			        	printDetectedPerson(results.toString(),worker_id,video,frames);
			        	detectedPerson = results.toString();
			      	}
      				if(faceExpressionsCounter % 15 == 0){
        				// faceExpressionsCounter = 0;
        				if(faceExpressionsCounter > TIMEOUT_TIME){
          					alert("You are timed out");
          					document.getElementById(`close_${worker_id}`).click();
			      			ResetAll(video,frames);
        				}
				        try{
				          if(Array.isArray(resizedDetections)){
				            let obj = resizedDetections[0].expressions;
				            // Expressions yaha print hore hai
				            printExpression(Object.keys(obj).reduce((a, b) => obj[a] > obj[b] ? a : b),faceMatcherisready,worker_id);
				          }
				          else{
				            // Expressions yaha print hore hai
				            printExpression(resizedDetections.expressions,faceMatcherisready,worker_id);
				          }
				        }catch{
				          //
				        }
      				}	
      				faceExpressionsCounter +=1;
    			}
  			}, 100);
		});
	}else{
		alert("Try Again in few seconds, Don't leave the page...");
	}
}



////////////// 			Functionality...		///////////////



// Checking the Name of Detected Person
function printDetectedPerson(person,worker_id,video,frames){
  if(!person.includes('unknown')){
    document.getElementById(`detected_person_${worker_id}`).innerHTML = person;
  }
  else{
    faceNotMatch += 1;
    if(faceNotMatch==FACE_NOT_MATCH_THRESHOLD){
    	document.getElementById(`close_${currentWorkerId}`).click();
    	ResetAll(video,frames);
    	alert("Your Face didn't match !!!");
    }
  }
}

// Printing & Checking the Expression...
function printExpression(exp,faceMatcherisready,worker_id){
  console.log("Your Exp: "+exp);
  if(faceMatcherisready){
    if(exp == randomExp[exprCounter]){
      if(exprCounter<3){
      	exprCounter += 1;
      	document.getElementById(`make_expr_${worker_id}`).innerHTML = "make: "+randomExp[exprCounter];
      	// console.log("do "+randomExp[exprCounter]);
      }
    }else{
      // alert("Expression didn't match");
    }
  }
}

// Generating Random Expressions...
function generateRandomExp(){
  let arr = [];
  let Expr = ['neutral','surprised','happy'];
  for(let i=0;i<3;i++){
    let rval =  Math.floor((Math.random() * 10) + 1) % Expr.length;
    arr.push(Expr[rval]);
  }
  return arr;
}

// Loading the labelled images of the person
function loadLabeledImages(worker_id) {
  const labels = [worker_id.toString()];
  return Promise.all(
    labels.map(async label => {
      const descriptions = [];
      for (let i = 1; i <= 10; i++) {
        const img = await faceapi.fetchImage(`images/${worker_id}-${i}.jpg`);
        const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
        descriptions.push(detections.descriptor);
      }
      return new faceapi.LabeledFaceDescriptors(label, descriptions);
    })
  )
}

// Displaying all workers & their present attendance using AJAX
function display_workers(){
    document.getElementById('refresh-table').disabled = true;
    
   //  let xhttp = new XMLHttpRequest();
   //  xhttp.onreadystatechange = function() {
	  //   if (this.readyState == 4 && this.status == 200) {
	  //   	document.getElementById("response").innerHTML = this.responsedata;
	  //   	document.getElementById('refresh-table').disabled = false;
	  //   }
  	// };
  	// xhttp.open("POST", "displayajax.php", true);
  	// xhttp.send();

    $.ajax({
        url: 'displayajax.php',
        type: 'post',
        success:function(responsedata){
            $('#response').html(responsedata);
            document.getElementById('refresh-table').disabled = false;
        }
    });
};

// Marking Absent Using Ajax
function markAbsent(worker_id){
    if(confirm("Mark WorkerID "+worker_id+" as Absent ?")){
    	var xhttp = new XMLHttpRequest();
	    xhttp.onreadystatechange = function(){
	        if (this.readyState == 4 && this.status == 200){
	            let data = this.responseText;
	            if(data == "A"){
	                alert(`Worker ID ${worker_id} is Marked Absent`);
	                display_workers();
	            }
	            else if(data == "Absent marking Failed"){
	                alert(data);
	            }else{ alert("Invalid Request"); }
	        }
	    };
	    xhttp.open("POST", "absent.php");
	    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	    xhttp.send("worker_id="+worker_id);
    }
}

// Reseting the js
function ResetAll(video,frames){
	display_workers();
	try{
		clearInterval(frames);
		video.pause();
	}catch{}
	video.src = "";
	//models_are_loaded = 0;
	faceMatcherisready=0;
	faceExpressionsCounter=0;
	exprCounter = 0;
	randomExp = [];
	faceNotMatch = 0;
	currentWorkerId = "";
	vidOff(video);
}

// Turning Off WebCam
function vidOff(vid){
  let video = document.getElementById(`video_${currentWorkerId}`);
  try{
    video.pause();
    video.src = "";
    video.srcObject.getTracks()[0].stop();
    //console.log("video is turned off");
  }catch{}
}