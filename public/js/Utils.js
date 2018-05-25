function string2file(content, filename) {
	var blob = new Blob(content , {type: "text/plain;charset=utf-8"} );
	saveAs(blob, filename);
}

function downloadAsFile(content_id, filename) {
	var content = [$("#"+content_id)[0].outerText];
	string2file(content, filename);
}

function canvas2PNG(canvas, filename) {
	canvas.toBlob(function(blob) {
		saveAs(blob, filename);
	});
}

function binaryblob(){
	var byteString = atob(document.querySelector("canvas").toDataURL().replace(/^data:image\/(png|jpg);base64,/, "")); //wtf is atob?? https://developer.mozilla.org/en-US/docs/Web/API/Window.atob
	var ab = new ArrayBuffer(byteString.length);
	var ia = new Uint8Array(ab);
	for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }
    var dataView = new DataView(ab);
	var blob = new Blob([dataView], {type: "image/png"});
	var DOMURL = self.URL || self.webkitURL || self;
	var newurl = DOMURL.createObjectURL(blob);

	var img = '<img src="'+newurl+'">'; 
  d3.select("#img").html(img);
}