$(document).ready(function () {
  // Show modal by default remove the click dependecy
  $('#messageModal').modal('show');

  // Edit form modal
  $('.editBarangayBtn').on('click', function () {
    var editBarangayID = $(this).data('edit-id');

    // AJAX request to fetch data based on the record ID
    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: { editBarangayID: editBarangayID },
      dataType: 'json',
      success: function (response) {
        // console.log(response);
        $('#editForm #updateBarangayID').val(response.Barangay_ID);
        $('#editForm #barangay').val(response.Barangay_Name);
        $('#editForm #town').val(response.Town_ID);
      },
      error: function (error) {
        console.error('Error fetching data:', error);
        // Handle error condition, display error message, etc.
      },
    });
  });

  $('#updateBarangayBtn').on('click', function () {
    var updateBarangayID = $('#editForm #updateBarangayID').val();
    var barangay = $('#editForm #barangay').val();
    var town = $('#editForm #town').val();

    // AJAX request to update the record with updated data
    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: {
        updateBarangayID: updateBarangayID,
        barangay: barangay,
        town: town,
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
      },
      error: function (xhr, status, error) {
        // Show error message modal for AJAX error
        // console.log(xhr.responseText);
        // $('#errorModal').find('.modal-body').text('Error occurred during updating.');
        // $('#errorModal').modal('show');
      },
    });
    $('#editModal').modal('hide');
  });

  $('.deleteBarangayBtn').on('click', function () {
    var deleteBarangayID = $(this).data('delete-id'); // Get the record ID from data attribute

    $('#confirmDeleteBtn')
      .off('click')
      .on('click', function () {
        $.ajax({
          url: 'process.php',
          method: 'POST',
          data: { deleteBarangayID: deleteBarangayID },
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
            // console.log(error);
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
  $('.editTownBtn').on('click', function () {
    var editTownID = $(this).data('edit-id');

    // AJAX request to fetch data based on the record ID
    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: { editTownID: editTownID },
      dataType: 'json',
      success: function (response) {
        // console.log(response);
        $('#editForm #updateTownID').val(response.Town_ID);
        $('#editForm #town').val(response.Town_Name);
        $('#editForm #province').val(response.Province_ID);
      },
      error: function (error) {
        console.error('Error fetching data:', error);
        // Handle error condition, display error message, etc.
      },
    });
  });

  $('#updateTownBtn').on('click', function () {
    var updateTownID = $('#editForm #updateTownID').val();
    var town = $('#editForm #town').val();
    var province = $('#editForm #province').val();

    // AJAX request to update the record with updated data
    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: {
        updateTownID: updateTownID,
        town: town,
        province: province,
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
        // console.log(error);
        // Show error message modal for AJAX error
        $('#errorModal').find('.modal-body').text('Error occurred during updating.');
        $('#errorModal').modal('show');
      },
    });
    // $('#editModal').modal('hide');
  });

  $('.deleteTownBtn').on('click', function () {
    var deleteTownID = $(this).data('delete-id'); // Get the record ID from data attribute

    $('#confirmDeleteBtn')
      .off('click')
      .on('click', function () {
        $.ajax({
          url: 'process.php',
          method: 'POST',
          data: { deleteTownID: deleteTownID },
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
  $('.editProvinceBtn').on('click', function () {
    var editProvinceID = $(this).data('edit-id');

    // AJAX request to fetch data based on the record ID
    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: { editProvinceID: editProvinceID },
      dataType: 'json',
      success: function (response) {
        // console.log(response);
        $('#editForm #updateProvinceID').val(response.Province_ID);
        $('#editForm #province').val(response.Province_Name);
      },
      error: function (error) {
        console.error('Error fetching data:', error);
        // Handle error condition, display error message, etc.
      },
    });
  });

  $('#updateProvinceBtn').on('click', function () {
    var updateProvinceID = $('#editForm #updateProvinceID').val();
    var province = $('#editForm #province').val();

    // AJAX request to update the record with updated data
    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: {
        updateProvinceID: updateProvinceID,
        province: province,
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

  $('.deleteProvinceBtn').on('click', function () {
    var deleteProvinceID = $(this).data('delete-id'); // Get the record ID from data attribute

    $('#confirmDeleteBtn')
      .off('click')
      .on('click', function () {
        $.ajax({
          url: 'process.php',
          method: 'POST',
          data: { deleteProvinceID: deleteProvinceID },
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
