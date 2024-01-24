var char_linea_subcontrato;

var ticksStyle = { fontColor: '#495057', fontStyle: 'bold' };
var mode = 'index';
var intersect = true;

function init() {

  $('#mEscritorio').addClass("active");

  tablero();  

  // ══════════════════════════════════════ S E L E C T 2 ══════════════════════════════════════

  
  // ══════════════════════════════════════ INITIALIZE SELECT2 ══════════════════════════════════════

  $("#valorizacion_filtro").select2({ theme: "bootstrap4", placeholder: "Filtro valorizacion", allowClear: true, });

  // Formato para telefono
  $("[data-mask]").inputmask();
}

function tablero() {   

  $.post("../ajax/escritorio.php?op=tablero",  function (e, status) {

    e = JSON.parse(e);  console.log(e);

    if (e.status == true) {
      $("#box_total_tours").html(`${e.data.total_tours}`);
      $("#box_total_paquete").html(`${e.data.total_paquete}`);
      $("#box_total_venta").html(`S/. ${formato_miles(e.data.total_ventas)}`);

      $("#cantidad_box_visita").html(`${e.data.visitas_pag.nombre_vista} ${e.data.visitas_pag.cantidad}`);
      $(".vista").html(e.data.visitas_pag.nombre_vista);

    } else {
      ver_errores(e);
    } 

  }).fail( function(e) { ver_errores(e); } );
}


init();

var color_label = [
  {'hex': '#f56954', 'rgba': 'rgba(255, 99, 132, 0.2)', }, 
  {'hex':'#00a65a', 'rgba': 'rgba(0, 166, 90, 0.2)',}, 
  {'hex':'#f39c12', 'rgba': 'rgba(243, 156, 18, 0.2)',}, 
  {'hex':'#00c0ef', 'rgba': 'rgba(0, 192, 239, 0.2)',}, 
  {'hex':'#3c8dbc', 'rgba': 'rgba(60, 141, 188, 0.2)',}, 
  {'hex':'#d2d6de', 'rgba': 'rgba(210, 214, 222, 0.2)',},
  {'hex':'#0002ff', 'rgba': 'rgba(0, 2, 255, 0.2)',},
  {'hex':'#675a33', 'rgba': 'rgba(103, 90, 51, 0.2)',},
  {'hex':'#d40000', 'rgba': 'rgba(212, 0, 0, 0.2)',},
];

// :::::::::::::::::::::::::::::::::::::  C H A R T  -  V I S I T A S  ::::::::::::::::::::::::
$(function () {
  $.post("../ajax/escritorio.php?op=vistas_pagina_web",  function (e, status) {

    e = JSON.parse(e);  console.log(e);
    var A_labels = [];
    var A_data = [];
    var donutOptions = {  maintainAspectRatio : false,  responsive : true, }

    if (e.status == true) {    
      
      e.data.char_donut.forEach((val, index) => { A_labels.push(`${val.nombre_vista} (${val.total})`); A_data.push(val.total);  });

      // ::::::::::::::::::::::::::::: CHART RADAR :::::::::::::::::::::::::::::::::::
      var datasets_radar = [];
      e.data.chart_radar.forEach((val, key) => {
        datasets_radar.push({
          label: `${val.nombre_vista} (${val.total})`,  data: val.dia,  fill: true,
          backgroundColor: color_label[key]['rgba'],
          borderColor: color_label[key]['hex'], pointBackgroundColor: color_label[key]['hex'], pointBorderColor: '#fff', pointHoverBackgroundColor: '#fff', pointHoverBorderColor: color_label[key]['hex']
        });
      });
      var $radarChartCanvas = $('#radar-chart-visita-por-dia');
      const data = {
        labels: [  'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo',],
        datasets: datasets_radar          
      };
      new Chart($radarChartCanvas, {
        type: 'radar',
        data: data,
        options: { elements: { line: { borderWidth: 3 } }, donutOptions  },
      });

      // ::::::::::::::::::::::::::::: CHART BARRAS :::::::::::::::::::::::::::::

      var $barras_v_x_m = $('#barras-chart-visita-por-mes')
      // eslint-disable-next-line no-unused-vars
      var barras_v_x_m = new Chart($barras_v_x_m, {
        type: 'bar',
        data: {
          labels: [ 'ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC'],
          datasets: [
            { backgroundColor: '#28a745', borderColor: '#28a745', data: e.data.chart_barra.mes, label: `Total visitas (${e.data.chart_barra.total})` },             
          ]
        },
        options: {
          maintainAspectRatio: false,
          tooltips: {  mode: mode, intersect: intersect },
          hover: { mode: mode, intersect: intersect },
          legend: { display: true },
          scales: {
            yAxes: [{ display: true, gridLines: { display: true, lineWidth: '4px', color: 'rgba(0, 0, 0, .2)', zeroLineColor: 'transparent' }, }],
            xAxes: [{ display: true, gridLines: { display: false }, ticks: ticksStyle }]
          }
        }
      });

      // ::::::::::::::::::::::::::::: CHART DONA :::::::::::::::::::::::::::::::::::
      var donutChartCanvas = $('#donut-chart-visita-por-pagina').get(0).getContext('2d');
      var donutData    = { labels: A_labels, datasets: [ { data: A_data, backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#0002ff'],  } ] }
      
      //Create pie or douhnut chart - You can switch between pie and douhnut using the method below.
      new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
      });

      // $('#radar-chart-visita-por-dia').css({'height': '450px', 'width': 'auto', 'display': 'inline' });
    } else {
      ver_errores(e);
    } 

  }).fail( function(e) { ver_errores(e); } );
})


// :::::::::::::::::::::::::::::::::::::  C H A R T  -  V E N T A S  ::::::::::::::::::::::::
$(function () {
  'use strict'   

    $.post("../ajax/escritorio.php?op=chart_producto",  function (e, status) {
  
      e = JSON.parse(e);  //console.log(e);
  
      if (e.status == true) {

        // ================================== Grafico Lineas ==================================

        var $visitorsChart = $('#venta-tours-chart')
        // eslint-disable-next-line no-unused-vars
        var visitorsChart = new Chart($visitorsChart, {
          data: {
            labels: [ 'ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGo', 'SEP', 'OCT', 'NOV', 'DIC'],
            datasets: [
              {
                type: 'line',
                data: e.data.tours_venta,
                backgroundColor: 'transparent',
                borderColor: '#28a745',
                pointBorderColor: '#28a745',
                pointBackgroundColor: '#28a745',
                fill: false,
                label: 'Total venta',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor    : '#28a745'
              },
              {
                type: 'line',
                data: e.data.tours_pagos,
                backgroundColor: 'tansparent',
                borderColor: '#ced4da',
                pointBorderColor: '#ced4da',
                pointBackgroundColor: '#ced4da',
                fill: false,
                label: 'Total pago',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor    : '#ced4da'
              }
            ]
          },
          options: {
            maintainAspectRatio: false,
            tooltips: { mode: mode, intersect: intersect },
            hover: { mode: mode, intersect: intersect },
            legend: { display: true },
            scales: {
              yAxes: [{
                // display: false,
                gridLines: { display: true, lineWidth: '4px', color: 'rgba(0, 0, 0, .2)', zeroLineColor: 'transparent' },
                ticks: $.extend({ beginAtZero: true, callback: function (value) { if (value >= 1000) { value /= 1000; value += 'k';  }  return 'S/ ' + value; } }, ticksStyle)
              }],
              xAxes: [{ display: true, gridLines: { display: false }, ticks: ticksStyle }]
            }
          }
        });

        // ================================== Grafico Barras ==================================

        var $salesChart = $('#venta-paquete-chart')
        // eslint-disable-next-line no-unused-vars
        var salesChart = new Chart($salesChart, {
          type: 'bar',
          data: {
            labels: [ 'ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC'],
            datasets: [
              { backgroundColor: '#28a745', borderColor: '#28a745', data: e.data.paquete_venta, label: 'Total venta' },
              { backgroundColor: '#ced4da', borderColor: '#ced4da', data: e.data.paquete_pagos, label: 'Total pago' },             
            ]
          },
          options: {
            maintainAspectRatio: false,
            tooltips: {  mode: mode, intersect: intersect },
            hover: { mode: mode, intersect: intersect },
            legend: { display: true },
            scales: {
              yAxes: [{
                // display: false,
                gridLines: { display: true, lineWidth: '4px', color: 'rgba(0, 0, 0, .2)',  zeroLineColor: 'transparent' },
                ticks: $.extend({ beginAtZero: true, callback: function (value) { if (value >= 1000) { value /= 1000; value += 'k';  }  return 'S/ ' + value; } }, ticksStyle)
              }],
              xAxes: [{ display: true, gridLines: { display: false }, ticks: ticksStyle }]
            }
          }
        });

        $("#btn-download-chart-linea").on('click', function () {       
          var a = document.createElement('a');
          a.href = visitorsChart.toBase64Image();
          a.download = 'ventas_y_pagos_por_mes.png';
          // Trigger the download
          a.click();
        });

        $("#btn-download-chart-barra").on('click', function () {       
          var a = document.createElement('a');
          a.href = salesChart.toBase64Image();
          a.download = 'Compras_y_kilos_por_mes.png';
          // Trigger the download
          a.click();
        });
      } else {
        ver_errores(e);
      } 
  
    }).fail( function(e) { ver_errores(e); } );
         
  
  // Ejecutamos los CHARTS
  // chart_producto();
  
})