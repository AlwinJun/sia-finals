$(document).ready(function () {
  const showAsideBtn = $('.show-side-btn');
  const sidebar = $('.sidebar');
  const wrapper = $('#wrapper');
  const slideNavDropdown = $('.sidebar-dropdown');

  showAsideBtn.on('click', function () {
    $(`#${$(this).data('show')}`).toggleClass('show-sidebar');
    wrapper.toggleClass('fullwidth');
  });

  if ($(window).innerWidth() < 767) {
    sidebar.addClass('show-sidebar');
  }

  $(window).on('resize', function () {
    if ($(window).innerWidth() > 767) {
      sidebar.removeClass('show-sidebar');
    }
  });

  $('.sidebar .categories').on('click', function (event) {
    const item = $(event.target).closest('.has-dropdown');

    if (!item.length) {
      return;
    }

    item.toggleClass('opened');

    item.siblings('.has-dropdown').removeClass('opened');

    if (item.hasClass('opened')) {
      const toOpen = item.find('.sidebar-dropdown');

      if (toOpen.length) {
        toOpen.addClass('active');
      }

      item.siblings('.has-dropdown').each(function () {
        const toClose = $(this).find('.sidebar-dropdown');

        if (toClose.length) {
          toClose.removeClass('active');
        }
      });
    }
  });

  $('.sidebar .close-aside').on('click', function () {
    $(`#${$(this).data('close')}`).addClass('show-sidebar');
    wrapper.removeClass('margin');
  });

  // Pagination & Search
  $('#example').DataTable({
    //disable sorting on last column
    scrollX: true,
    // retrieve: true,
    // paging: false,
    // searching: false,
    columnDefs: [
      {
        orderable: false,
        targets: 1,
      },
    ],
    language: {
      //customize pagination prev and next buttons: use arrows instead of words
      paginate: {
        previous: '<span class="fa fa-chevron-left"></span>',
        next: '<span class="fa fa-chevron-right"></span>',
      },
      //customize number of elements to be displayed
      lengthMenu:
        'Display <select class="form-control input-sm">' +
        '<option value="10">10</option>' +
        '<option value="20">20</option>' +
        '<option value="30">30</option>' +
        '<option value="40">40</option>' +
        '<option value="50">50</option>' +
        '<option value="-1">All</option>' +
        '</select> results',
    },
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf'],
  });
});
