$(document).ready(function(){
  $.ajax({
    url: "http://localhost/hr_profiling/data.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var player = [];
      var score = [];

      for(var i in data) {
        player.push("SG" + data[i].Male);
        score.push(data[i].Female);
      }

      var chartdata = {
        labels: player,
        datasets : [
          {
            label: 'Player Score',
            backgroundColor: 'rgba(10, 200, 70, 0.75)',
            borderColor: 'rgba(180, 200, 170, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(60, 150, 80, 1)',
            data: score
          }
        ]
      };

      var ctx = $("#mycanvas");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});