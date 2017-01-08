        // Hide/show toggle button on scroll

  var position, direction, previous;

  $(window).scroll(function(){
    if( $(this).scrollTop() >= position ){
      direction = 'down';
      if(direction !== previous){
        $('.menu-toggle').addClass('hide');

        previous = direction;
      }
    } else {
      direction = 'up';
      if(direction !== previous){
        $('.menu-toggle').removeClass('hide');

        previous = direction;
      }
    }
    position = $(this).scrollTop();
  });

$("#mygallery").justifiedGallery({
	'randomize': true,
  'rowHeight': 220,

});


lightbox.option({
      'disableScrolling': true,
      'showImageNumberLabel': false,
      'wrapAround': true
    });


var filearray = [];
function fileupload(file){
  	// var myDropzone = new Dropzone("#myDropzone");
  	for (var i = 0; i<=file.length - 1; i++) {
  			// console.log(file[i].name);
        filearray[i]= file[i].name;
        

  	};

  	// var tmppath = file[0].name;
      // $("#images-imageurl").val(tmppath);
      // console.log(myDropzone.files.getAcceptedFiles());
}


function postfile(){
  // console.log(filearray);

  for (var i = 0; i<=filearray.length - 1; i++) {
    $("#imagearray").append('<input type="text" name="Images[file][]" value="'+filearray[i]+'" hidden >');
  };

}



