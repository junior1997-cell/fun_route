var chart_bar;
var chart_radar;

//Función que se ejecuta al inicio
function init() {

    $(".mescritorio").addClass("active");

    // grafico_uno();
    // grafico_dos ();
    filtros();
}

function grafico_bar(fecha_1,fecha_2) {

  $.post("../ajax/escritorio.php?op=grafico_barras", { 'fecha_1': fecha_1 , 'fecha_2':fecha_2}, function (e, status) {

    e = JSON.parse(e);   console.log(e);

    if (e.status == true) {

      var chart_bar_div = $("#myChart");

      if (chart_bar) {  chart_bar.destroy();  } 

      chart_bar = new Chart(chart_bar_div, {

          type: 'bar',
          data: {
              labels: ['Inicio', 'Servicios', 'Proveedores', 'Obras', 'Contactos'],
              datasets: [{
                 label: 'Todos',
                data: e.data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 4
            }]
              
          },
          options: {
            responsive: true,
            scales: { y: { beginAtZero: true } },
            datalabels: { display: false, },
          }
      });

      $('.cargando').hide();

    } else {

      ver_errores(e);

    }

  }); 

}

function grafico_radar(fecha_1,fecha_2) { 

  $.post("../ajax/escritorio.php?op=grafico_radar", { 'fecha_1': fecha_1 , 'fecha_2':fecha_2}, function (e, status) {

    e = JSON.parse(e);   console.log(e);

    if (e.status == true) {

      var chart_radar_div =$("#chart_radar");

      if (chart_radar) {  chart_radar.destroy();  } 

      chart_radar = new Chart(chart_radar_div, {
        type: 'radar',
        data: {
          labels: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes','Sábado'],
          datasets: [
            {
              label:  'inicio',
              data: e.data.Home,
              backgroundColor: [ 'rgba(255, 99, 132, 0.2)', ],
              borderColor: [ 'rgba(255, 99, 132, 1)', ],
              borderWidth: 1
            },
            {
              label:  'Servicios',
              data: e.data.Servicios,
              backgroundColor: [ 'rgba(54, 162, 235, 0.2)', ],
              borderColor: [ 'rgba(54, 162, 235, 1)', ],
              borderWidth: 1
            },
            {
              label:  'Proveedores',
              data:  e.data.Proveedores,
              backgroundColor: [ 'rgba(255, 206, 86, 0.2)', ],
              borderColor: [ 'rgba(255, 206, 86, 1)', ],
              borderWidth: 1
            },
            {
              label:  'Obras',
              data:  e.data.NuestrasObras,
              backgroundColor: [ 'rgba(75, 192, 192, 0.2)', ],
              borderColor: [ 'rgba(75, 192, 192, 1)', ],
              borderWidth: 1
            },
            {
              label:  'Contactos',
              data:  e.data.Contactos,
              backgroundColor: [ 'rgba(153, 102, 255, 0.2)', ],
              borderColor: [ 'rgba(153, 102, 255, 1)', ],
              borderWidth: 1
            }
          ]
        },
        options: {
          responsive: true,
          plugins: { title: { display: true, text: 'Visitas por día' } }
        },
      });

      $('.cargando').hide();

    } else {

      ver_errores(e);

    }

  });

}

init();


function cargando_search() {
  $('.cargando').show().html(`<i class="fas fa-spinner fa-pulse fa-sm"></i> Buscando ...`);
}

function filtros() {  

  var fecha_1       = $("#filtro_fecha_inicio").val();
  var fecha_2       = $("#filtro_fecha_fin").val();  
 
  grafico_bar(fecha_1,fecha_2); 
  
  grafico_radar(fecha_1,fecha_2);

}