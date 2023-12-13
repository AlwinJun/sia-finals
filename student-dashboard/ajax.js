$(document).ready(function () {
  $('#editPasswordForm').submit(function (event) {
    event.preventDefault(); // Prevent the form from submitting

    var updatePasswordID = $('#editPasswordForm #updatePasswordID').val();
    var password = $('#editPasswordForm #updatePassword').val();
    var confirmPassword = $('#editPasswordForm #confirmPassword').val();

    // If all validations pass, submit the form
    // this.submit();

    if (password !== confirmPassword) {
      alert('Password and Confirm Password do not match');
      return;
    }

    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: {
        updatePasswordID: updatePasswordID,
        password: password,
        confirmPassword: confirmPassword,
      },
      dataType: 'json',
      success: function (response) {
        if (response.success) {
          // Show success message modal
          $('#successModal').find('.modal-body').text(response.message);
          $('#successModal').modal('show');
        } else {
          // Show error message modal
          $('#errorModal').find('.modal-body').text(response.message);
          $('#errorModal').modal('show');
        }

        $('#successModal').on('hidden.bs.modal', function () {
          // Reload the browser to update the table content
          location.reload();
        });
      },
      error: function (xhr, status, error) {
        console.log('XHR status: ' + xhr.status);
        console.log('Status: ' + status);
        console.log('Error: ' + error);

        // Show error message modal for AJAX error
        $('#errorModal').find('.modal-body').text('Error occurred during updating.');
        $('#errorModal').modal('show');
      },
    });
    $('#editPassowrdModal').modal('hide');
  });
});
