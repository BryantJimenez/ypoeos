/*
=========================================
|                                       |
|           Scroll To Top               |
|                                       |
=========================================
*/ 
$('.scrollTop').click(function() {
  $("html, body").animate({scrollTop: 0});
});


$('.navbar .dropdown.notification-dropdown > .dropdown-menu, .navbar .dropdown.message-dropdown > .dropdown-menu ').click(function(e) {
  e.stopPropagation();
});

/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

  var checker = $('#' + clickchk);
  var multichk = $('.' + relChkbox);


  checker.click(function () {
    multichk.prop('checked', $(this).prop('checked'));
  });    
}


/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
    */

    function multiCheck(tb_var) {
      tb_var.on("change", ".chk-parent", function() {
        var e=$(this).closest("table").find("td:first-child .child-chk"), a=$(this).is(":checked");
        $(e).each(function() {
          a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
      }),
      tb_var.on("change", "tbody tr .new-control", function() {
        $(this).parents("tr").toggleClass("active")
      })
    }

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

  var checker = $('#' + clickchk);
  var multichk = $('.' + relChkbox);


  checker.click(function () {
    multichk.prop('checked', $(this).prop('checked'));
  });    
}

/*
=========================================
|                                       |
|               Tooltips                |
|                                       |
=========================================
*/

$('.bs-tooltip').tooltip();

/*
=========================================
|                                       |
|               Popovers                |
|                                       |
=========================================
*/

$('.bs-popover').popover();


/*
================================================
|                                              |
|               Rounded Tooltip                |
|                                              |
================================================
*/

$('.t-dot').tooltip({
  template: '<div class="tooltip status rounded-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
})


/*
================================================
|            IE VERSION Dector                 |
================================================
*/

function GetIEVersion() {
  var sAgent = window.navigator.userAgent;
  var Idx = sAgent.indexOf("MSIE");

  // If IE, return version number.
  if (Idx > 0) 
    return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

  // If IE 11 then look for Updated user agent string.
  else if (!!navigator.userAgent.match(/Trident\/7\./)) 
    return 11;

  else
    return 0; //It is not IE
}

//////// Scripts ////////
$(document).ready(function() {
  //Validación para introducir solo números
  $('.number, #phone').keypress(function() {
    return event.charCode >= 48 && event.charCode <= 57;
  });
  //Validación para introducir solo letras y espacios
  $('#name, #lastname, .only-letters').keypress(function() {
    return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32;
  });
  //Validación para solo presionar enter y borrar
  $('.date').keypress(function() {
    return event.charCode == 32 || event.charCode == 127;
  });

  //select2
  if ($('.select2').length) {
    $('.select2').select2({
      language: "es",
      placeholder: "Seleccione",
      tags: true
    });
  }

  //Datatables normal
  if ($('.table-normal').length) {
    $('.table-normal').DataTable({
      "oLanguage": {
        "oPaginate": {
          "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
          "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
        },
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>'
      },
      "stripeClasses": [],
      "lengthMenu": [10, 20, 50, 100, 200, 500],
      "pageLength": 10
    });
  }

  if ($('.table-export').length) {
    $('.table-export').DataTable({
      dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
      buttons: {
        buttons: [
        { extend: 'copy', className: 'btn' },
        { extend: 'csv', className: 'btn' },
        { extend: 'excel', className: 'btn' },
        { extend: 'print', className: 'btn' }
        ]
      },
      "oLanguage": {
        "oPaginate": {
          "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
          "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
        },
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>'
      },
      "stripeClasses": [],
      "lengthMenu": [10, 20, 50, 100, 200, 500],
      "pageLength": 10
    });
  }

  //dropify para input file más personalizado
  if ($('.dropify').length) {
    $('.dropify').dropify();
  }

  //datepicker material
  if ($('.dateMaterial').length) {
    $('.dateMaterial').bootstrapMaterialDatePicker({
      lang : 'es',
      time: false,
      cancelText: 'Cancelar',
      clearText: 'Limpiar',
      format: 'DD-MM-YYYY',
      maxDate : new Date()
    });
  }

  // flatpickr
  if ($('#flatpickr').length) {
    flatpickr(document.getElementById('flatpickr'), {
      locale: 'es',
      enableTime: false,
      dateFormat: "d-m-Y",
      maxDate : "today"
    });
  }

  //Mapa de leaflet
  if ($('#lat').length && $('#lng').length && $('#map').length) {
    var lat=$('#lat').val(), lng=$('#lng').val();
    var map=L.map('map', {
      center: [lat, lng],
      zoom: 7
    });

    marker=L.marker([lat, lng]).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
  }

  if ($('#lat').length && $('#lng').length && $('#map-implementer').length) {
    var lat=38.81510115312363, lng=-99.755859375;
    if ($('#lat').val()!="" && $('#lng').val()!="") {
      lat=$('#lat').val();
      lng=$('#lng').val();
    }

    var map=L.map('map-implementer', {
      center: [lat, lng],
      zoom: 5
    });

    marker=L.marker([lat, lng]).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    map.on('click', function(e) {
      if (marker) {
        map.removeLayer(marker);
      }

      marker=L.marker(e.latlng).addTo(map);
      $('#lat').val(e.latlng.lat);
      $('#lng').val(e.latlng.lng);
    });
  }

  //CKeditor plugin
  if ($('#why-works').length) {
    CKEDITOR.config.language='en';
    CKEDITOR.config.height=400;
    CKEDITOR.config.width='auto';
    CKEDITOR.config.removePlugins='image,table,tableselection,tabletools,pastefromword,pastetools,specialchar,about';
    CKEDITOR.replace('why-works');
  }

  if ($('#experience').length) {
    CKEDITOR.config.language='en';
    CKEDITOR.config.height=200;
    CKEDITOR.config.width='auto';
    CKEDITOR.config.removePlugins='image,table,tableselection,tabletools,pastefromword,pastetools,specialchar,about';
    CKEDITOR.replace('experience');
  }
});

// funcion para cambiar el input hidden al cambiar el switch de estado
$('#stateCheckbox').change(function(event) {
  if ($(this).is(':checked')) {
    $('#stateHidden').val(1);
  } else {
    $('#stateHidden').val(0);
  }
});

// funcion para cambiar el input hidden al cambiar el switch de boton
$('#buttonCheckbox').change(function(event) {
  if ($(this).is(':checked')) {
    $('#buttonHidden').val(1);
    $('#buttonInputs').removeClass('d-none');
  } else {
    $('#buttonHidden').val(0);
    $('#buttonInputs').addClass('d-none');
  }
});

//funciones para desactivar y activar usuarios
function deactiveAdmin(slug) {
  $("#deactiveAdmin").modal();
  $('#formDeactiveAdmin').attr('action', '/admin/administrators/' + slug + '/deactivate');
}

function activeAdmin(slug) {
  $("#activeAdmin").modal();
  $('#formActiveAdmin').attr('action', '/admin/administrators/' + slug + '/activate');
}

function deactiveImplementer(slug) {
  $("#deactiveImplementer").modal();
  $('#formDeactiveImplementer').attr('action', '/admin/implementers/' + slug + '/deactivate');
}

function activeImplementer(slug) {
  $("#activeImplementer").modal();
  $('#formActiveImplementer').attr('action', '/admin/implementers/' + slug + '/activate');
}

function deactiveBanner(slug) {
  $("#deactiveBanner").modal();
  $('#formDeactiveBanner').attr('action', '/admin/banners/' + slug + '/deactivate');
}

function activeBanner(slug) {
  $("#activeBanner").modal();
  $('#formActiveBanner').attr('action', '/admin/banners/' + slug + '/activate');
}

function deactiveTestimonial(slug) {
  $("#deactiveTestimonial").modal();
  $('#formDeactiveTestimonial').attr('action', '/admin/testimonials/' + slug + '/deactivate');
}

function activeTestimonial(slug) {
  $("#activeTestimonial").modal();
  $('#formActiveTestimonial').attr('action', '/admin/testimonials/' + slug + '/activate');
}

//funciones para preguntar al eliminar
function deleteAdmin(slug) {
  $("#deleteAdmin").modal();
  $('#formDeleteAdmin').attr('action', '/admin/administrators/' + slug);
}

function deleteImplementer(slug) {
  $("#deleteImplementer").modal();
  $('#formDeleteImplementer').attr('action', '/admin/implementers/' + slug);
}

function deleteBanner(slug) {
  $("#deleteBanner").modal();
  $('#formDeleteBanner').attr('action', '/admin/banners/' + slug);
}

function deleteTestimonial(slug) {
  $("#deleteTestimonial").modal();
  $('#formDeleteTestimonial').attr('action', '/admin/testimonials/' + slug);
}