  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>

    <script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
  </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Statistic', 'Current data'],
          ['Users', <?php echo User::count_all(); ?>],
          ['Views', <?php echo $session->count; ?>],
          ['Photos', <?php echo Photo::count_all(); ?>],
          ['Comments', <?php echo Comment::count_all(); ?>]
        ]);

        var options = {
          title: 'Quick Chart',
          legend: 'none',
          pieSliceText: 'label',
          backgroundColor: 'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

</body>

</html>
