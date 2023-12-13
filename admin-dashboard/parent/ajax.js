$(document).ready(function () {
  // Dropdowns province,town,barangay
  $('#province').change(function () {
    const provinceID = $(this).val();
    if (provinceID !== '') {
      fetchTowns(provinceID);
    }
  });

  $('#town').change(function () {
    const townID = $(this).val();
    if (townID !== '') {
      fetchBarangay(townID);
    }
  });

  function fetchTowns(provinceID) {
    $.ajax({
      url: 'process.php',
      method: 'GET',
      data: { provinceID: provinceID },
      dataType: 'json',
      success: function (towns) {
        let options = '<option value="">Select Town</option>';
        towns.forEach(function (town) {
          options += `<option value="${town.Town_ID}">${town.Town_Name}</option>`;
        });
        $('#town').html(options);
      },
      error: function (error) {
        console.error('Error:', error);
      },
    });
  }

  function fetchBarangay(townID) {
    $.ajax({
      url: 'process.php',
      method: 'GET',
      data: { townID: townID },
      dataType: 'json',
      success: function (brgy) {
        let options = '<option value="">Select City</option>';
        brgy.forEach(function (brgy) {
          options += `<option value="${brgy.Barangay_ID}">${brgy.Barangay_Name}</option>`;
        });
        $('#barangay').html(options);
      },
      error: function (error) {
        console.error('Error:', error);
      },
    });
  }
  // Show modal by default remove the click dependecy
  $('#messageModal').modal('show');

  // Edit form modal
  $('.editParentBtn').on('click', function () {
    var editParentID = $(this).data('edit-id');

    // AJAX request to fetch data based on the record ID
    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: { editParentID: editParentID },
      dataType: 'json',
      success: function (response) {
        $('#updateParentID').val(response.Parent_ID);
        $('#firstName').val(response.ParentFirstname);
        $('#middleName').val(response.ParentMiddlename);
        $('#lastName').val(response.ParentLastname);
        $('#extension').val(response.ParentExtensionname);
        $('#bday').val(response.Parent_Birthdate);
        $('#age').val(response.Parent_Age);
        $('#gender').val(response.Gender_ID);
        $('#civilStatus').val(response.Civil_Status_ID);
        $('#street').val(response.Street_Number);
        $('#address').val(response.Address_Name);
        $('#province').val(response.Province_ID);
        $('#town').val(response.Town_ID);
        $('#barangay').val(response.Barangay_ID);
        $('#zip').val(response.Zipcode);
        $('#username').val(response.Parent_Username);
        $('#password').val(response.Parent_Password);
      },
      error: function (error) {
        console.error('Error fetching data:', error);
        // Handle error condition, display error message, etc.
      },
    });
  });

  $('#updateParentBtn').on('click', function () {
    var updateParentID = $('#updateParentID').val();
    var firstName = $('#firstName').val();
    var middleName = $('#middleName').val();
    var lastName = $('#lastName').val();
    var extension = $('#extension').val();
    var bday = $('#bday').val();
    var age = $('#age').val();
    var gender = $('#gender').val();
    var civilStatus = $('#civilStatus').val();
    var street = $('#street').val();
    var address = $('#address').val();
    var province = $('#province').val();
    var town = $('#town').val();
    var barangay = $('#barangay').val();
    var zip = $('#zip').val();
    var username = $('#username').val();
    var password = $('#password').val();

    // AJAX request to update the record with updated data
    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: {
        updateParentID: updateParentID,
        firstName: firstName,
        middleName: middleName,
        lastName: lastName,
        extension: extension,
        bday: bday,
        age: age,
        gender: gender,
        civilStatus: civilStatus,
        street: street,
        province: province,
        address: address,
        town: town,
        barangay: barangay,
        zip: zip,
        username: username,
        password: password,
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

  $('.deleteParentButton').on('click', function () {
    var deleteID = $(this).data('delete-id'); // Get the record ID from data attribute

    $('#confirmDeleteBtn')
      .off('click')
      .on('click', function () {
        $.ajax({
          url: 'process.php',
          method: 'POST',
          data: { deleteID: deleteID },
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
          error: function (error) {
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
