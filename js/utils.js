const searchById = document.getElementById('searchById');
const searchByLastName = document.getElementById('searchByLastName');
const searchByName = document.getElementById('searchByName');
$('.close_delete_emp_modal').on('click', function(e) {
	$('#delete_emp_modal')
		.css('display', 'none')
		.css('opacity', 0);
});
$('.close_delete_proj_modal').on('click', function(e) {
	$('#delete_proj_modal')
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
