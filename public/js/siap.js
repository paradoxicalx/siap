$('.loadhtml').on('click', function() {
  $('#main-content').load($(this).data('url'))
  $('.loadhtml').closest('li').removeClass('active')
  $('.loadhtml').closest('.parent').removeClass('active')
  $(this).closest('li').addClass('active')
  $(this).closest('.parent').removeClass('parent-focus').addClass('active')
})

const table_button = [
  {
    extend:    'copyHtml5',
    text:      '<a class="far fa-copy"></a>',
    titleAttr: 'Copy to Clipboard'
  },
  {
    extend:    'excelHtml5',
    text:      '<a class="far fa-file-excel"></a>',
    titleAttr: 'Export to Excel'
  },
  {
    extend:    'csvHtml5',
    text:      '<a class="fas fa-file-csv"></a>',
    titleAttr: 'Export to CSV'
  },
  {
    extend:    'pdfHtml5',
    text:      '<a class="far fa-file-pdf"></a>',
    titleAttr: 'Export to PDF'
  },
  {
    extend:    'print',
    text:      '<a class="fas fa-print"></a>',
    titleAttr: 'Print'
  },
  {
    extend:    'colvis',
    text:      '<a class="fas fa-eye-slash"></a>',
    titleAttr: 'Column visibility',
    className: 'btn-info'
  }
];
