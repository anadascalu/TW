   <h3>
     Cutremurul a avut loc in orasul : <?php echo $post['oras']; ?>
   </h3>
   <div class="container">
    <?PHP
    $qwrmorti = "SELECT * FROM tw.morti WHERE idCutremur = '".$post['idCutremur']."' ";
    $morti = $this->db->query($qwrmorti);
    $nrmorti = $morti->num_rows();
    $qwrnevatamati = "SELECT * FROM tw.nevatamati WHERE idCutremur = '".$post['idCutremur']."' ";
    $nevatamati = $this->db->query($qwrnevatamati);
    $nrnevatamati = $nevatamati->num_rows();
    $qwrraniti = "SELECT * FROM tw.raniti WHERE idCutremur = '".$post['idCutremur']."' ";
    $raniti = $this->db->query($qwrraniti);
    $nrraniti = $raniti->num_rows();

    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Tip', 'Persoane'],
          ['Morti',     <?PHP echo $nrmorti; ?>],
          ['Nevatamati',      <?PHP echo $nrnevatamati; ?>],
          ['Raniti', <?PHP echo $nrraniti; ?>]
          ]);

        var options = {
          width: 600 ,
          height: 400,
          title: '',
          is3D: true,
        };

        var chart_div = document.getElementById('piechart_3d');
        var chart = new google.visualization.PieChart(chart_div);

      // Wait for the chart to finish drawing before calling the getImageURI() method.
      google.visualization.events.addListener(chart, 'ready', function () {
        chart_div.innerHTML = '<img src="' + chart.getImageURI() + '">';
        console.log(chart_div.innerHTML);
        document.getElementById('png').outerHTML = '<a href="' + chart.getImageURI() + '">Vizualizati diagrama</a>';
      });

      chart.draw(data, options);
    }
  </script>
  
  
  <div id="png"></div>
  <div id="piechart_3d" style="width: 900px; height: 500px;" ></div>
  <?php $link = "SELECT link FROM tw.maps WHERE idCutremur = '".$post['idCutremur']."' ";
  $maps = $this->db->query($link);
  $nrmaps = $maps->num_rows();
  if ($nrmaps != 0)
  {
    foreach ($maps->result() as $row)
    {
      $linkmaps=$row->link;
    }
    ?>
    <iframe src="<?php echo $linkmaps; ?>" width="600" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
    <?PHP
  }
  ?>
  


  <div class="posted-at">
    La data de: <?php echo $post['date'];
    ?>
  </div>

  <br>
  <div class="post-body"> Cu magnitudinea de: 
    <?php echo $post['magnitudine']; ?>
  </div>
</div>

<hr>
<a class="btn btn-default" href="edit/<?php echo $post['oras']; ?>"> EDIT</a>
<?php echo form_open('/posts/delete/'.$post['idCutremur']); ?>
<input type="submit" value="Delete" class="btn btn-danger">
</form>


