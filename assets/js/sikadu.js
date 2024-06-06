

$(document).ready(function()
{

  $('#DataTables').DataTable({
  });

  $('.DataTables').DataTable({
  });

  $('.nav-item').on('click', function() {
    $('.nav-item').removeClass('active');
    $(this).addClass('active');
  });

  var dtMonFilt = $('#dtMonthFilter').DataTable({
    "dom":  "<'row'<'col-sm-4'l><'col-sm-4' <'monthsearchbox'>><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>"
  });

  $("div.monthsearchbox").html('<div class="input-group"> <span class="input-group-text"> Periode </span><input type="month" class="form-control form-control-sm pull-right" id="monthsearch" placeholder="Search by date.."> </div>');

  $("#monthsearch", this).change(function() {
    if (dtMonFilt.column(0).search() !== this.value)
    {
      dtMonFilt
        .column(0)
        .search(this.value)
        .draw();
    }
  });

  $("#monthsearch").val(getMonth());
  dtMonFilt.columns(0).search( $('#monthsearch').val() ).draw();

  $('.summernote').summernote({
    height: 300,      // set editor height
    minHeight: null,  // set minimum height of editor
    maxHeight: null,  // set maximum height of editor
    focus: true       // set focus to editable area after initializing summernote
  });

  $(".select2").select2();

  $("#checkAll").click(function () {
    $(".checkbox").prop('checked', $(this).prop('checked'));
  });

  Highcharts.chart('chart-container', {
    legend: {
      enabled: false
    },
    title: {
      text: 'Berat Badan menurut Umur'
    },
    xAxis: {
      title: {
        text: 'Umur (Bulan)'
      },
      min: 0,
      max: 60
    },
    yAxis: {
      title: {
        text: 'Berat Badan (Kg)'
      },
      min: 0
    },
    tooltip: {
      headerFormat: '<b>{series.name}</b><br/>',
      pointFormat: 'Umur: {point.x} Bulan <br/> Berat: {point.y} Kg',
      crosshairs: [true, true]
    },
    plotOptions: {
      series: {
        color: 'black'
      }
    },
    series: [
      {
        color: '#fed330',
        type: 'line',
        data: data_bb[0],
        marker: {
          enabled: false
        },
        states: {
          hover: {
            lineWidth: 0
          }
        },
        enableMouseTracking: false
      },
      {
        color: '#26de81',
        type: 'line',
        data: data_bb[1],
        marker: {
          enabled: false
        },
        states: {
          hover: {
            lineWidth: 0
          }
        },
        enableMouseTracking: false
      },
      {
        color: '#20bf6b',
        type: 'line',
        data: data_bb[2],
        marker: {
          enabled: false
        },
        states: {
          hover: {
            lineWidth: 0
          }
        },
        enableMouseTracking: false
      },
      {
        color: '#20bf6b',
        type: 'line',
        data: data_bb[3],
        marker: {
          enabled: false
        },
        states: {
          hover: {
            lineWidth: 0
          }
        },
        enableMouseTracking: false
      },
      {
        color: '#20bf6b',
        type: 'line',
        data: data_bb[4],
        marker: {
          enabled: false
        },
        states: {
          hover: {
            lineWidth: 0
          }
        },
        enableMouseTracking: false
      },
      {
        color: '#26de81',
        type: 'line',
        data: data_bb[5],
        marker: {
          enabled: false
        },
        states: {
          hover: {
            lineWidth: 0
          }
        },
        enableMouseTracking: false
      },
      {
        color: '#fed330',
        type: 'line',
        data: data_bb[6],
        marker: {
          enabled: false
        },
        states: {
          hover: {
            lineWidth: 0
          }
        },
        enableMouseTracking: false
      },
      {
        name: '',
        type: 'scatter',
        data: [klien_bb],
        marker: {
          radius: 4
        }
      }
    ]
  });

});

function getMonth()
{
  var date  = new Date();
  var year  = date.getFullYear();
  var month = date.getMonth() + 1;
  month     = ('0' + month).slice(-2)
  return year + "-" + month;
}

function validateRemove(ev)
{
  ev.preventDefault();
  var uri = ev.currentTarget.getAttribute('href');
  swal ({
    title: "Apakah anda yakin?",
    text: "Setelah dihapus, data tidak dapat dikembalikan!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete)
    {
      swal({
        title: "Data berhasil dihapus!",
        icon: "success",
      })
      .then(okay => {
        // if (okay)
        // {
        //   window.location.href = uri;
        // }
        window.location.href = uri;
      });
    }
    else
    {
      swal("Data batal dihapus!");
    }
  });
}

function cetakLaporanTahunan()
{
  var periode = $('#monthsearch').val();
  var url = 'laporan/cetak.php?periode=' + periode;
  window.open(url, '_blank').focus();
}
