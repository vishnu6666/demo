<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-12 text-left"> 
      <table class="table table-striped table-bordered nowrap dataTable dt-responsive">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Text</th>
                <th>Dropdown</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($dataList)): ?> 
        <?php foreach ($dataList as $key => $art): ?>
        <tr>
        	<td><?php  echo $art->id; ?></td>
        	<td><?php  echo $art->text; ?></td>
        	<td><?php  echo $art->dropdown; ?></td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
        <td colspan="3">Not data available</td>
        </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <?php  echo $this->pagination->create_links();   ?>
    </div>
  </div>
</div>