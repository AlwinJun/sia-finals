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

  // Delete Modal
  $('.deleteBtn').on('click', function () {
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

  // Edit form modal
  $('.editBtn').on('click', function () {
    var editID = $(this).data('edit-id');

    // AJAX request to fetch data based on the record ID
    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: { editID: editID },
      dataType: 'json',
      success: function (response) {
        $('#studentID').val(response.Student_ID);
        $('#firstName').val(response.Firstname);
        $('#middleName').val(response.Middlename);
        $('#lastName').val(response.Lastname);
        $('#extension').val(response.Extensionname);
        $('#bday').val(response.Birthdate);
        $('#age').val(response.Age);
        $('#gender').val(response.Gender_ID);
        $('#civilStatus').val(response.Civil_Status_ID);
        $('#street').val(response.Street_Number);
        $('#address').val(response.Address_Name);
        $('#province').val(response.Province_ID);
        $('#town').val(response.Town_ID);
        $('#barangay').val(response.Barangay_ID);
        $('#zip').val(response.Zipcode);
        $('#parent').val(response.Parent_ID);
        $('#username').val(response.Student_Username);
        $('#password').val(response.Student_Password);
      },
      error: function (error) {
        console.error('Error fetching data:', error);
        // Handle error condition, display error message, etc.
      },
    });
  });

  $('#updateStudent').on('click', function () {
    var studentID = $('#studentID').val();
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
    var parent = $('#parent').val();
    var username = $('#username').val();
    var password = $('#password').val();

    // AJAX request to update the record with updated data
    $.ajax({
      url: 'process.php',
      method: 'POST',
      data: {
        studentID: studentID,
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
        parent: parent,
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
    $('#editModal').modal('hide');
  });
});
