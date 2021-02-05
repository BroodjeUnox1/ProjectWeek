const animateCSS = (element, animation, prefix = 'animate__') =>
  // We create a Promise and return it
  new Promise((resolve, reject) => {
    const animationName = `${prefix}${animation}`;
    const node = document.querySelector(element);

    node.classList.add(`${prefix}animated`, animationName);

    // When the animation ends, we clean the classes and resolve the Promise
    function handleAnimationEnd(event) {
      event.stopPropagation();
      node.classList.remove(`${prefix}animated`, animationName);
      resolve('Animation ended');
    }

    node.addEventListener('animationend', handleAnimationEnd, {once: true});
  });


// Toggle the modals
function ToggleModal(Modal) {
  $(Modal).modal("toggle");
}


function edit(el){
		console.log(el)
		var data = el.dataset;

		Object.keys(data).forEach(function (key) {
		    let value = data[key];
		    console.log(`${key} - ${value}`)

		    $(`#edit_${key}`).val(value)

		});

		$('#edit_modal').modal('toggle')
	}


function update(){
	var title = $('#edit_title').val()		
	var thread = $('#edit_thread').val()
	var id = $('#edit_id').val()

	$.post('./api/update/update.php', {title: title, thread: thread, id: id}, function(response){
		console.log(response)
		if(response == 'Success'){
			$('#edit_modal').modal('toggle')
		}
	})
}
	