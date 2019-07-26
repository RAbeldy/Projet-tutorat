var overlay = document.getElementById('overlay');
var btnPopup = document.getElementById('btnPopup');
var close = document.getElementById('close');
var submit = document.getElementById('submit');




var openModal = function()
{
	overlay.style.display = 'block';
}
var closeModal = function()
{
	overlay.style.display = 'none';
}

btnPopup.addEventListener('click',openModal);
close.addEventListener('click',closeModal);
submit.addEventListener('click',closeModal);