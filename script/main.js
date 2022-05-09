let removeItem = document.querySelectorAll('.remove');

removeItem.forEach((btn) =>{
	btn.addEventListener('click', function() {
		confirm('es tu sur de vouloir supprimer cette objet ?');
	})
})