$(document).ready(function () {
  $('#messageModal').modal('show');

  // Edit form modal
  $('.editGenderBtn').on('click', function () {
    var editGenderID = $(this).data('edit-id');

    // AJAX request to fetch data based on the record ID
    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: { editGenderID: editGenderID },
      dataType: 'json',
      success: function (response) {
        // console.log(response);
        $('#editForm #updateGenderID').val(response.Gender_ID);
        $('#editForm #gender').val(response.Gender_Name);
      },
      error: function (error) {
        console.error('Error fetching data:', error);
        // Handle error condition, display error message, etc.
      },
    });
  });

  $('#updateGenderBtn').on('click', function () {
    var updateGenderID = $('#editForm #updateGenderID').val();
    var gender = $('#editForm #gender').val();

    // AJAX request to update the record with updated data
    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: {
        updateGenderID: updateGenderID,
        gender: gender,
      },
      dataType: 'json',
      success: function (response) {
        if (response.success) {
          // Show success message modal
          // $('#successModal').find('.modal-body').text(response.message);
          // $('#successModal').modal('show');
        } else {
          // Show error message modal
          $('#errorModal').find('.modal-body').text(response.message);
          $('#errorModal').modal('show');
        }
      },
      error: function (error) {
        console.log(error);
        // Show error message modal for AJAX error
        $('#errorModal').find('.modal-body').text('Error occurred during updating.');
        $('#errorModal').modal('show');
      },
    });
    // $('#editModal').modal('hide');
  });

  $('.deleteGenderBtn').on('click', function () {
    var deleteGenderID = $(this).data('delete-id'); // Get the record ID from data attribute

    $('#confirmDeleteBtn')
      .off('click')
      .on('click', function () {
        $.ajax({
          url: 'process.php',
          method: 'POST',
          data: { deleteGenderID: deleteGenderID },
          dataType: 'json',
          success: function (response) {
            if (response.success) {
              // Show success message modal
              $('#successModal').find('.modal-body').text(response.message);
              $('#successModal').modal('show');
            } else {
              console.log(response);
              // Show error message modal
              $('#errorModal').find('.modal-body').text(response.message);
              $('#errorModal').modal('show');
            }

            $('#successModal').on('hidden.bs.modal', function () {
              // Reload the browser to update the table content
              location.reload();
            });
          },
          error: function (error) {
            console.log(error);
            // Show error message modal for AJAX error
            $('#errorModal').find('.modal-body').text('Error occurred during deletion.');
            $('#errorModal').modal('show');
          },
        });

        // Hide the delete modal after deletion
        $('#deleteModal').modal('hide');
      });
  });

  // Edit form modal
  $('.editCivilBtn').on('click', function () {
    var editCivilID = $(this).data('edit-id');

    // AJAX request to fetch data based on the record ID
    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: { editCivilID: editCivilID },
      dataType: 'json',
      success: function (response) {
        // console.log(response);
        $('#editForm #updateCivilID').val(response.Civil_Status_ID);
        $('#editForm #civilStatus').val(response.Civil_Status_Name);
      },
      error: function (error) {
        console.error('Error fetching data:', error);
        // Handle error condition, display error message, etc.
      },
    });
  });

  $('#updateCivilBtn').on('click', function () {
    var updateCivilID = $('#editForm #updateCivilID').val();
    var civilStatus = $('#editForm #civilStatus').val();

    // AJAX request to update the record with updated data
    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: {
        updateCivilID: updateCivilID,
        civilStatus: civilStatus,
      },
      dataType: 'json',
      success: function (response) {
        if (response.success) {
          // Show success message modal
          // $('#successModal').find('.modal-body').text(response.message);
          // $('#successModal').modal('show');
        } else {
          // Show error message modal
          $('#errorModal').find('.modal-body').text(response.message);
          $('#errorModal').modal('show');
        }
      },
      error: function (error) {
        console.log(error);
        // Show error message modal for AJAX error
        $('#errorModal').find('.modal-body').text('Error occurred during updating.');
        $('#errorModal').modal('show');
      },
    });
    // $('#editModal').modal('hide');
  });

  $('.deleteCivilBtn').on('click', function () {
    var deleteCivilID = $(this).data('delete-id'); // Get the record ID from data attribute

    $('#confirmDeleteBtn')
      .off('click')
      .on('click', function () {
        $.ajax({
          url: 'process.php',
          method: 'POST',
          data: { deleteCivilID: deleteCivilID },
          dataType: 'json',
          success: function (response) {
            if (response.success) {
              // Show success message modal
              $('#successModal').find('.modal-body').text(response.message);
              $('#successModal').modal('show');
            } else {
              console.log(response);
              // Show error message modal
              $('#errorModal').find('.modal-body').text(response.message);
              $('#errorModal').modal('show');
            }

            $('#successModal').on('hidden.bs.modal', function () {
              // Reload the browser to update the table content
              location.reload();
            });
          },
          error: function (error) {
            console.log(error);
            // Show error message modal for AJAX error
            $('#errorModal').find('.modal-body').text('Error occurred during deletion.');
            $('#errorModal').modal('show');
          },
        });

        // Hide the delete modal after deletion
        $('#deleteModal').modal('hide');
      });
  });
});
