const searchById = document.getElementById('searchById');
const searchByLastName = document.getElementById('searchByLastName');
const searchByName = document.getElementById('searchByName');
$('.closeDeleteEmpModal').on('click', function(e) {
	$('#deleteEmpModal')
		.css('display', 'none')
		.css('opacity', 0);
});
$('.closeDeleteProjModal').on('click', function(e) {
	$('#deleteProjModal')
		.css('display', 'none')
		.css('opacity', 0);
});

$('.closeUnassignEmpModal').on('click', function(e) {
	$('#unassignEmpModal')
		.css('display', 'none')
		.css('opacity', 0);
});

$('#searchByIdForm').on('submit', function(e) {
	if (searchById.value.length === 0) {
		e.preventDefault();
		$('#searchUiValidationMessage').text('Please enter a value');
	}
});
$('#searchByLastnameForm').on('submit', function(e) {
	if (searchByLastName.value.length === 0) {
		e.preventDefault();
		$('#searchUiValidationMessage').text('Please enter a value');
	}
});
$('#searchByNameForm').on('submit', function(e) {
	if (searchByName.value.length === 0) {
		e.preventDefault();
		$('#searchUiValidationMessage').text('Please enter a value');
	}
});
