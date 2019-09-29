//get modal
var modal=document.getElementById('simpleModal');
//Get open modal button
var modalBtn = document.getElementById('modalBtn');
//Get cose Button
var closeBtn = document.getElementsByClassName('closeBtn')[0];


//listen for open click
modalBtn.addEventListener('click', openModal);
//listen for close click
closeBtn.addEventListener('click', closeModal);
//listen for outside click
window.addEventListener('click', outsideClick);

//function to open Modal
function openModal(){
	modal.style.display = 'block';
}

//function to close modal
function closeModal(){
	modal.style.display = 'none';
}

//function to close modal if outside clcik
function outsideClick(e){
	if(e.target == modal)
	modal.style.display = 'none';
}
