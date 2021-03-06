		<div class="container" style="margin-top:75px;">
	      	<ul class="breadcrumb" style="margin-top:15px;margin-bottom: 5px;">
	            <li><a href="<?php echo base_url();?>">Home</a></li>
                <li><a href="<?php echo base_url();?>event">Event</a></li>
				<li><a href="<?php echo base_url().'event/detail/'.$urlhelper->id_event;?>"><?php echo $urlhelper->event;?></a></li>
				<li class="active"><a href="<?php echo base_url().'event/detail/'.$urlhelper->id_event;?>"><?php echo $urlhelper->nama_kelas;?></a></li>
				<li class="active"><a href="<?php echo base_url().'event/detail/'.$urlhelper->id_event?>"><?php echo $urlhelper->jenis;?></a></li>
            </ul>
	   	</div> 

	   	<div class="container">
	   		<?php if($this->session->flashdata('error_msg') != ""){?>
	      	<div class="alert alert-danger">
	      		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	      		<strong>ERROR! </strong><?php echo $this->session->flashdata('error_msg');?>
	      	</div>
	      	<?php } else if ($this->session->flashdata('success_msg') != ""){?>
	      	<div class="alert alert-success">
	      		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	      		<strong>SUCCESS! </strong><?php echo $this->session->flashdata('success_msg');?>
	      	</div>
	      	<?php } else if ($this->session->flashdata('info_msg') != ""){?>
	      	<div class="alert alert-info">
	      		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	      		<strong>INFO! </strong><?php echo $this->session->flashdata('info_msg');?>
	      	</div>
	      	<?php } ?>
	   	</div> 

	   	<div class="container">
	   		<div class="row">
	   		<div class="col-md-12">
	   			<h3>Pengajuan Nominasi <?php echo $urlhelper->event;?> <span class="text-muted"></span></h3>
		  		<h4>Kelas : <?php echo $urlhelper->nama_kelas;?> | Jenis Burung : <?php echo $urlhelper->jenis;?><span class="text-muted"></span></h4>
	   		</div>
	   		</div>
	   	</div>

	   	<div class="container">
	   		<ul class="nav nav-tabs" style="margin-bottom: 15px;">
				<li class="active"><a href="#homecpt" data-toggle="tab">Pengajuan Nominasi Cepat</a></li>
				<li><a href="#home" data-toggle="tab">Pengajuan Nominasi</a></li>
				<li><a href="#profile" data-toggle="tab">Ranking Nominasi</a></li>
				<li <?php echo ($jenis->koncer_dibuka == 0) ? "class='disabled'" : "" ?>><a href="#koncer" data-toggle="tab">Koncer</a></li>
				<li <?php echo ($jenis->koncer_dibuka == 0) ? "class='disabled'" : "" ?>><a href="#hasil" data-toggle="tab">Hasil Koncer</a></li>
			</ul>

			<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade active in" id="homecpt">
			  	<div class="bs-example table-responsive">
	              <table id="editnilai" class="table table-striped table-bordered table-hover">
	                <thead>
	                  <tr class="success">
	                    <th width='70px'>Kode Juri</th>
	                    <th width='200px'>Nama</th>
						<th colspan='13'>Input Langsung 1-15</th>
						<th colspan='2'>Submit</th>
	                  </tr>
	                </thead>
	                <tbody>
					  <!-- Pengawas -->
	                  <tr class="warning">
	                    <td colspan="17">Pengawas</td>
	                  </tr>
						  <?php
						  if($pengawas == null){
						  	echo '
						  	<tr>
								<td colspan="17" class="text-center"> <strong>--- Belum ada Data ---</strong></td>
						  	</tr>';
						  }
						  $count = 1;
						  foreach($pengawas as $p){
						  	$testl = $p->id_juri;
							$testk = $this->uri->segment(4)	;
							$ci = &get_instance();
							$ci->load->model('nilai_model');
							$jumlah_n = $ci->nilai_model->hitungJumlahNilai($testl,$testk);
						  ?>
						  <tr>
							<td><?php echo "P$count";?></td>
							<td><a href="#" id="editnama" data-pk="<?php echo $p->id_juri;?>"><?php echo $p->nama;?></a></td>
								
							<?php echo form_open('nilai/tambah'); echo form_hidden('id_juri',$p->id_juri); echo form_hidden('id_event',$this->uri->segment(3)); echo form_hidden('id_jenis',$this->uri->segment(4));?>
							<td colspan="13"><input type="text" class="form-control" value="<?php foreach($p->nilai as $n) { echo $n->gantangan . " ";} ?>" name="frmnilai" <?php echo (($jumlah_n == 15) ? "disabled" : "")?>></td>
							<td colspan="2"><?php echo form_submit(array('class' => 'btn btn-primary btn-block', 'value' => 'Simpan'));?></td>
							<?php echo form_close();?>
						  </tr>
						  <?php $count+=1;} ?>

					 <!-- Inspektur Pelaksana -->
	                  <tr class="warning">
	                    <td colspan="17">Inspektur Pelaksana</td>
	                  </tr>
						  <?php
						  if($inspektur == null){
						  	echo '
						  	<tr>
								<td colspan="17" class="text-center"> <strong>--- Belum ada Data ---</strong></td>
						  	</tr>';
						  }
						  $count = 1;
						  foreach($inspektur as $p){
						  	$testl = $p->id_juri;
							$testk = $this->uri->segment(4)	;
							$ci = &get_instance();
							$ci->load->model('nilai_model');
							$jumlah_n = $ci->nilai_model->hitungJumlahNilai($testl,$testk);
						  ?>
						  <tr>
							<td><?php echo "IP$count";?></td>
							<td><a href="#" id="editnama" data-pk="<?php echo $p->id_juri;?>"><?php echo $p->nama;?></a></td>
							<?php echo form_open('nilai/tambah'); echo form_hidden('id_juri',$p->id_juri); echo form_hidden('id_event',$this->uri->segment(3)); echo form_hidden('id_jenis',$this->uri->segment(4));?>
							<td colspan="13"><input type="text" class="form-control" name="frmnilai" value="<?php foreach($p->nilai as $n) { echo $n->gantangan . " ";} ?>" <?php echo (($jumlah_n == 15) ? "disabled" : "")?>></td>
							<td colspan="2"><?php echo form_submit(array('class' => 'btn btn-primary btn-block', 'value' => 'Simpan'));?></td>
							<?php echo form_close();?>
						  </tr>
						  <?php $count+=1;} ?>

					<!-- Koordinator Lapangan -->
	                  <tr class="warning">
	                    <td colspan="17">Koordinator Lapangan</td>
	                  </tr>
						  <?php
						  if($korlap == null){
						  	echo '
						  	<tr>
								<td colspan="17	" class="text-center"> <strong>--- Belum ada Data ---</strong></td>
						  	</tr>';
						  }
						  $count = 1;
						  foreach($korlap as $p){
						  	$testl = $p->id_juri;
							$testk = $this->uri->segment(4)	;
							$ci = &get_instance();
							$ci->load->model('nilai_model');
							$jumlah_n = $ci->nilai_model->hitungJumlahNilai($testl,$testk);
						  ?>
						  <tr>
							<td><?php echo "K$count";?></td>
							<td><a href="#" id="editnama" data-pk="<?php echo $p->id_juri;?>"><?php echo $p->nama;?></a></td>
							<?php echo form_open('nilai/tambah'); echo form_hidden('id_juri',$p->id_juri); echo form_hidden('id_event',$this->uri->segment(3)); echo form_hidden('id_jenis',$this->uri->segment(4));?>
							<td colspan="13"><input type="text" class="form-control" name="frmnilai" value="<?php foreach($p->nilai as $n) { echo $n->gantangan . " ";} ?>" <?php echo (($jumlah_n == 15) ? "disabled" : "")?>></td>
							<td colspan="2"><?php echo form_submit(array('class' => 'btn btn-primary btn-block', 'value' => 'Simpan'));?></td>
							<?php echo form_close();?>
						  </tr>
						  <?php $count+=1;} ?>

					  <!-- Juri -->
	                  <tr class="warning">
	                    <td colspan="17">Juri</td>
	                  </tr>
						  <?php
						  if($juri == null){
						  	echo '
						  	<tr>
								<td colspan="17" class="text-center"> <strong>--- Belum ada Data ---</strong></td>
						  	</tr>';
						  }
						  $count = 1;
						  foreach($juri as $p){
						  	$testl = $p->id_juri;
							$testk = $this->uri->segment(4)	;
							$ci = &get_instance();
							$ci->load->model('nilai_model');
							$jumlah_n = $ci->nilai_model->hitungJumlahNilai($testl,$testk);
						  ?>
						  <tr>
							<td><?php echo "A$count";?></td>
							<td><a href="#" id="editnama" data-pk="<?php echo $p->id_juri;?>"><?php echo $p->nama;?></a></td>
							<?php echo form_open('nilai/tambah'); echo form_hidden('id_juri',$p->id_juri); echo form_hidden('id_event',$this->uri->segment(3)); echo form_hidden('id_jenis',$this->uri->segment(4));?>
							<td colspan="13"><input type="text" class="form-control" name="frmnilai" value="<?php foreach($p->nilai as $n) { echo $n->gantangan . " ";} ?>" <?php echo (($jumlah_n == 15) ? "disabled" : "")?>></td>
							<td colspan="2"><?php echo form_submit(array('class' => 'btn btn-primary btn-block', 'value' => 'Simpan'));?></td>
							<?php echo form_close();?>
						  </tr>
						  <?php $count+=1;} ?>
	                </tbody>
	              </table>
            	</div>
			</div>

			<div class="tab-pane fade" id="home">
				  <div class="bs-example table-responsive">
	              <table id="editnilai" class="table table-striped table-bordered table-hover">
	                <thead>
	                  <tr class="success">
	                    <th width='70px'>Kode Juri</th>
	                    <th width='200px'>Nama</th>
						
						<?php
						for($i = 1; $i <= 15; $i++)
						echo "<th width='38px'>$i</th>";
	                    ?>
	                  </tr>
	                </thead>
	                <tbody>
	                <!-- Pengawas -->
	                  <tr class="warning">
	                    <td colspan="17">Pengawas</td>
	                  </tr>
						  <?php
						  if($pengawas == null){
						  	echo '
						  	<tr>
								<td colspan="17" class="text-center"> <strong>--- Belum ada Data ---</strong></td>
						  	</tr>';
						  }
						  $count = 1;
						  foreach($pengawas as $p){
						  ?>
						  <tr>
							<td><?php echo "P$count";?></td>
							<td><a href="#" id="editnama" data-pk="<?php echo $p->id_juri;?>"><?php echo $p->nama;?></a></td>
							<?php foreach($p->nilai as $n) { ?>
								<td>
									<a href="#" id="edit" data-pk="<?php echo $n->id_nilai;?>"><?php echo $n->gantangan;?></a>
								</td>
							<?php } ?>
						  </tr>
						  <?php $count+=1;} ?>

					 <!-- Inspektur Pelaksana -->
	                  <tr class="warning">
	                    <td colspan="17">Inspektur Pelaksana</td>
	                  </tr>
						  <?php
						  if($inspektur == null){
						  	echo '
						  	<tr>
								<td colspan="17" class="text-center"> <strong>--- Belum ada Data ---</strong></td>
						  	</tr>';
						  }
						  $count = 1;
						  foreach($inspektur as $p){
						  ?>
						  <tr>
							<td><?php echo "IP$count";?></td>
							<td><a href="#" id="editnama" data-pk="<?php echo $p->id_juri;?>"><?php echo $p->nama;?></a></td>
							<?php foreach($p->nilai as $n) { ?>
								<td>
									<a href="#" id="edit" data-pk="<?php echo $n->id_nilai;?>"><?php echo $n->gantangan;?></a>
								</td>
							<?php } ?>
						  </tr>
						  <?php $count+=1;} ?>

					<!-- Koordinator Lapangan -->
	                  <tr class="warning">
	                    <td colspan="17">Koordinator Lapangan</td>
	                  </tr>
						  <?php
						  if($korlap == null){
						  	echo '
						  	<tr>
								<td colspan="17" class="text-center"> <strong>--- Belum ada Data ---</strong></td>
						  	</tr>';
						  }
						  $count = 1;
						  foreach($korlap as $p){
						  ?>
						  <tr>
							<td><?php echo "K$count";?></td>
							<td><a href="#" id="editnama" data-pk="<?php echo $p->id_juri;?>"><?php echo $p->nama;?></a></td>
							<?php foreach($p->nilai as $n) { ?>
								<td>
									<a href="#" id="edit" data-pk="<?php echo $n->id_nilai;?>"><?php echo $n->gantangan;?></a>
								</td>
							<?php } ?>
						  </tr>
						  <?php $count+=1;} ?>

					  <!-- Juri -->
	                  <tr class="warning">
	                    <td colspan="17">Juri</td>
	                  </tr>
						  <?php
						  if($juri == null){
						  	echo '
						  	<tr>
								<td colspan="17" class="text-center"> <strong>--- Belum ada Data ---</strong></td>
						  	</tr>';
						  }
						  $count = 1;
						  foreach($juri as $p){
						  ?>
						  <tr>
							<td><?php echo "A$count";?></td>
							<td><a href="#" id="editnama" data-pk="<?php echo $p->id_juri;?>"><?php echo $p->nama;?></a></td>
							<?php foreach($p->nilai as $n) { ?>
								<td>
									<a href="#" id="edit" data-pk="<?php echo $n->id_nilai;?>"><?php echo $n->gantangan;?></a>
								</td>
							<?php } ?>
						  </tr>
						  <?php $count+=1;} ?>
	                </tbody>
	              </table>
	            </div>
			</div>

			<!-- TAB HASIL NOMINASI -->
			<div class="tab-pane fade" id="profile">
			<!-- TABLE NOMINASI START -->
				
			  <div class="bs-example table-responsive">
					
				  <div class="col-lg-4">
				  <a href="<?php echo base_url()."nilai/export_nominasitext/".$urlhelper->id_jenis;?>" target="_BLANK">Export ke text</a>  |  
				  <a href="<?php echo base_url()."nilai/export_nominasi/".$urlhelper->id_jenis;?>" target="_BLANK">Export ke excel</a>
				  <table id="datanominasi" class="table table-striped table-bordered table-hover">
					<thead>
					  <tr class="success">
						<th style="text-align:center;">No Urut</th>
						<th style="text-align:center;">Nomor Gantangan</th>
						<th style="text-align:center;">Jumlah Pengajuan (Nilai Mentok 38)</th>
						<th style="text-align:center;">Ranking</th>
					  </tr>
					</thead>
					<tbody>
					<?php 
					$ranking = 0;
					$jml = 100;
					$no = 1;
					foreach($nominasi as $n){ 
						if($n->jumlah_gantangan < $jml) {
							$ranking++;$jml = $n->jumlah_gantangan;
						}
						
						if($no <= $jenis->jumlah_koncer){
							echo "<tr class='warning'>";
						}else{
							echo "<tr>";
						}
					?>
					  
						<td style="text-align:center;"><?php echo $no;?></th>
						<td style="text-align:center;"><?php echo $n->gantangan;?></th>
						<td style="text-align:center;"><?php echo $n->jumlah_gantangan;?></th>
						<td style="text-align:center;"><?php echo $ranking;?></th>
					  </tr>
					  <?php 
					  $no+=1;
					  }?>
					</tbody>
				   </table>
				   
				   
				   <!--MEMBUKA KONCER-->
				   <div class="row">
					<label class="lead">
						<?php
							if($jenis->koncer_dibuka != 0){
							echo "Tahap koncer telah dibuka untuk $jenis->jumlah_koncer peserta";
							}else{
							echo "Buka tahap koncer";
							}
						?>
					</label>
				   </div>
				   <form class="bs-example form-horizontal" action="<?php echo base_url();?>jenis/bukakoncer" method="POST" accept-charset="utf-8">
				   <div class="row">
					   <label for="select" class="col-lg-8 control-label">
						<?php
							if($jenis->koncer_dibuka != 0){
							echo "Rubah jumlah peserta";
							}else{
							echo "Jumlah peserta koncer: ";
							}
						?>
					   </label>
					   <input type="hidden" id="id_jenis" name="id_jenis" value="<?php echo $urlhelper->id_jenis;?>"/>
					   <input type="hidden" id="id_event" name="id_event" value="<?php echo $urlhelper->id_event;?>"/>
					   <div class="col-lg-4">
						  <select class="form-control" id="select" name="select">
							  <?php
								for($j = 1; $j < $no; $j++){
									echo "<option value='$j'>$j</option>";
								}
							  ?>
						  </select>
						</div>
					</div>	  
					  <div class="row">
						  <button type="submit" class="btn btn-primary">Simpan</button> 
					  </div>
					</form>
					
				  </div>
				  <div class="col-lg-8">
				  <!--CHART NOMINASI-->
					<div id="nominasichart" style="margin: 0 auto"></div>
				  </div>
			</div>
		  </div>
		  
		  <!-- TAB KONCER -->
		  <div class="tab-pane fade" id="koncer">
			
			<!-- TABLE START -->
			  <div class="bs-example table-responsive">
              <table id="editnilai" class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="warning text-center">
                    <td colspan="5">Juri</td>
                  </tr>
                  <tr class="success">
                    <th width='70px'>Kode Juri</th>
                    <th width='200px'>Nama</th>
					
					<?php
					
					echo "<th>Koncer A</th>";
					echo "<th>Koncer B</th>";
					echo "<th>Koncer C</th>";
					echo "<th>Reset Koncer</th>";
                    ?>
                  </tr>
                </thead>
                <tbody>
				  
				  <!-- Juri -->
					  <?php
					  $count = 1;
					  foreach($juri as $p){
					  ?>
					  <tr>
						<td><?php echo "A$count";?></td>
						<td><?php echo $p->nama;?></td>
						<td>
							<a href="#" id="editkoncera" data-type="select" data-pk="<?php echo $p->koncer->id_koncer;?>"
							data-value="0" 
							data-source="<?php echo base_url()."nilai/list_koncer/".$urlhelper->id_jenis."/".$jenis->jumlah_koncer;?>" 
							data-title="Pilih koncer" class="editable editable-click" data-original-title="" 
							title="" style="background-color: rgba(0, 0, 0, 0);"><?php echo $p->koncer->koncera;?></a>						
						</td>
						<td>
							<a href="#" id="editkoncerb" data-type="select" data-pk="<?php echo $p->koncer->id_koncer;?>"
							data-value="0" 
							data-source="<?php echo base_url()."nilai/list_koncer/".$urlhelper->id_jenis."/".$jenis->jumlah_koncer;?>" 
							data-title="Pilih koncer" class="editable editable-click" data-original-title="" 
							title="" style="background-color: rgba(0, 0, 0, 0);"><?php echo $p->koncer->koncerb;?></a>
						</td>
						<td>
							<a href="#" id="editkoncerc" data-type="select" data-pk="<?php echo $p->koncer->id_koncer;?>"
							data-value="0" 
							data-source="<?php echo base_url()."nilai/list_koncer/".$urlhelper->id_jenis."/".$jenis->jumlah_koncer;?>" 
							data-title="Pilih koncer" class="editable editable-click" data-original-title="" 
							title="" style="background-color: rgba(0, 0, 0, 0);"><?php echo $p->koncer->koncerc;?></a>
						</td>
						<td>
							<a href="<?php echo base_url()."nilai/reset_koncer/".$p->id_juri."/".$urlhelper->id_jenis."/".$this->uri->segment(3);?>" class="btn btn-primary btn-block" style="text-decoration:none;">Reset</a>
						</td>
					  </tr>
					  <?php $count+=1;} ?>				  
                </tbody>
              </table>
            </div>
			<!-- TABLE END -->
			</div>
			
			<!-- TAB HASIL KONCER -->
			<div class="tab-pane fade" id="hasil">
			<!-- TABLE NOMINASI START -->
				
			  <div class="bs-example table-responsive">
					
				  <div class="col-lg-12">
				  <a href="<?php echo base_url()."nilai/export_hasil/".$urlhelper->id_jenis;?>" target="_BLANK">Export ke excel</a>
				  <table id="datanominasi" class="table table-striped table-bordered table-hover">
					<thead>
					  <tr class="success">
						<th style="text-align:center;">Juara</th>
						<th style="text-align:center;">Nomor Gantangan</th>
						<th style="text-align:center;">Jumlah Pengajuan</th>
						<th style="text-align:center;">Koncer A</th>
						<th style="text-align:center;">Koncer B</th>
						<th style="text-align:center;">Koncer C</th>
						<th style="text-align:center;">Total Nilai</th>
					  </tr>
					</thead>
					<tbody>
					<?php 
					$ranking = 0;
					$jml = 100;
					$no = 1;
					foreach($koncer as $n){ 
						if($n->jumlah_gantangan < $jml) {
							$ranking++;$jml = $n->jumlah_gantangan;
						}
					?>	
						<tr>
					
						<td style="text-align:center;"><?php echo $no;?></td>
						<td style="text-align:center;"><?php echo $n->gantangan;?></td>
						<td style="text-align:center;"><?php echo $n->jumlah_gantangan;?></td>
						<td style="text-align:center;"><?php echo $n->koncer->jumlah_koncera;?></td>
						<td style="text-align:center;"><?php echo $n->koncer->jumlah_koncerb;?></td>
						<td style="text-align:center;"><?php echo $n->koncer->jumlah_koncerc;?></td>
						<td style="text-align:center;"><?php echo $n->total_nilai;?></td>
					  </tr>
					  <?php 
					  $no+=1;
					  }?>
					</tbody>
				   </table>
					
				  </div>
				 
			</div>
		  </div>
	  	</div>
	   	</div>
	
	<!-- Modal Pengawas -->
	<div class="modal fade" id="modalPengawas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		 <form class="bs-example form-horizontal" action="<?php echo base_url();?>juri/add" method="POST" accept-charset="utf-8">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Tambah Pengawas</h4>
		  </div>
		  <div class="modal-body">
			  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pengawas" required autofocus>
			  <input type="hidden" id="tipe_juri" name="tipe_juri" value="1">
			  <input type="hidden" id="id_jenis" name="id_jenis" value="<?php echo $urlhelper->id_jenis;?>">
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			<button type="submit" class="btn btn-primary">Tambahkan</button>
		  </div>
		 </form>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<!-- Modal INSPEKTUR -->
	<div class="modal fade" id="modalInspektur" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		 <form class="bs-example form-horizontal" action="<?php echo base_url();?>juri/add" method="POST" accept-charset="utf-8">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Tambah Inspektur Pelaksana</h4>
		  </div>
		  <div class="modal-body">
			  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Inspektur Pelaksana" required autofocus>
			  <input type="hidden" id="tipe_juri" name="tipe_juri" value="2">
			  <input type="hidden" id="id_jenis" name="id_jenis" value="<?php echo $urlhelper->id_jenis;?>">
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			<button type="submit" class="btn btn-primary">Tambahkan</button>
		  </div>
		 </form>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
      <!-- Modal KORLAP -->
	<div class="modal fade" id="modalKorlap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		 <form class="bs-example form-horizontal" action="<?php echo base_url();?>juri/add" method="POST" accept-charset="utf-8">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Tambah Koordinator Lapangan</h4>
		  </div>
		  <div class="modal-body">
			  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Korlap" required autofocus>
			  <input type="hidden" id="tipe_juri" name="tipe_juri" value="3">
			  <input type="hidden" id="id_jenis" name="id_jenis" value="<?php echo $urlhelper->id_jenis;?>">
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			<button type="submit" class="btn btn-primary">Tambahkan</button>
		  </div>
		 </form>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	
	<!-- Modal JURI -->
	<div class="modal fade" id="modalJuri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		 <form class="bs-example form-horizontal" action="<?php echo base_url();?>juri/add" method="POST" accept-charset="utf-8">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="myModalLabel">Tambah Juri</h4>
		  </div>
		  <div class="modal-body">
			  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Juri" required autofocus>
			  <input type="hidden" id="tipe_juri" name="tipe_juri" value="4">
			  <input type="hidden" id="id_jenis" name="id_jenis" value="<?php echo $urlhelper->id_jenis;?>">
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			<button type="submit" class="btn btn-primary">Tambahkan</button>
		  </div>
		 </form>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="navbar navbar-inverse navbar-static-bottom" role="navigation" style="margin-top:151px">
            <div class="container">
            <div class="text-center">
            <p style="color:#000;padding-top:15px">Copyright &copy; Kicau Mania . Created by <strong>Pandawa</strong> Rama Zeta signature</p>
            </div>
            </div>

	</div>

	</div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>public/js/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url();?>public/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>public/js/holder.js"></script>
	<link href="<?php echo base_url();?>public/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
	<script src="<?php echo base_url();?>public/bootstrap3-editable/js/bootstrap-editable.js"></script>
	<script src="<?php echo base_url();?>public/js/highcharts.js"></script>
	<script src="<?php echo base_url();?>public/js/exporting.js"></script>
  </body>
</html>

<script>
$(document).ready(function() {
 //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'popup';     
    
    $('#editnilai #edit').editable({
	type: 'text',
    name: 'nilai',
    url: '<?php echo base_url()."nilai/edit";?>',
    title: 'Rubah gantangan: '
	});

	$('#edit-nb').editable({
	type: 'text',
    name: 'nama_burung',
    url: '<?php echo base_url()."nilai/editkoncer/nb";?>',
    title: 'Rubah Nama Burung: '
	});

	$('#edit-pb').editable({
	type: 'text',
    name: 'pemilik_burung',
    url: '<?php echo base_url()."nilai/editkoncer/pb";?>',
    title: 'Rubah Nama Burung: '
	});

	$('#edit-ap').editable({
	type: 'text',
    name: 'alamat_pemilik',
    url: '<?php echo base_url()."nilai/editkoncer/ap";?>',
    title: 'Rubah Nama Burung: '
	});
	
	$('#edit-k').editable({
	type: 'text',
    name: 'keterangan',
    url: '<?php echo base_url()."nilai/editkoncer/k";?>',
    title: 'Rubah Nama Burung: '
	});

	$('#editnilai #editkoncera').editable({
	type: 'text',
    name: 'koncera',
    url: '<?php echo base_url()."nilai/editkoncer/koncera";?>',
    title: 'Rubah koncer: '
	});
	
	$('#editnilai #editkoncerb').editable({
	type: 'text',
    name: 'koncerb',
    url: '<?php echo base_url()."nilai/editkoncer/koncerb";?>',
    title: 'Rubah koncer: '
	});
	
	$('#editnilai #editkoncerc').editable({
	type: 'text',
    name: 'koncerc',
    url: '<?php echo base_url()."nilai/editkoncer/koncerc";?>',
    title: 'Rubah koncer: '
	});
	
    $('#editnilai #editnama').editable({
	type: 'text',
    name: 'nama',
    url: '<?php echo base_url()."juri/edit";?>',
    title: 'Rubah Nama: '
	});
	
	$('#nominasichart').highcharts({
            chart: {
                type: 'bar', 
                height: 800
            },
            title: {
                text: 'Hasil Nominasi'
            },
            xAxis: {
				title:{text: "Gantangan"},
                categories: [
				<?php
				$size = count($nominasi);
				for($j = 0; $j < $size; $j++){
				$gantangan = $nominasi[$j]->gantangan;
					
					echo "'$gantangan'";
					if($j < $size-1)echo ",";
				}
				?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Pengajuan'
                }
            },
			  plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                enabled: false
            },			
            tooltip: {
				headerFormat: 'Gantangan <b>{point.x}</b><br/>',
                pointFormat: 'Jumlah pengajuan sebanyak <b>{point.y}</b>',
            },
            series: [{
                name: 'Pengajuan',
                data: [
					<?php
						$size = count($nominasi);
						for($j = 0; $j < $size; $j++){
						$jml = $nominasi[$j]->jumlah_gantangan;
							
							echo "$jml";
							if($j < $size-1)echo ",";
						}
					?>
				]
            }]
        });
});

function confirmDelete()
{
var x;
var r=confirm("Yakin akan menghapus?");
if (r==true)
  {
  
  }else{
  return false;
  }
}

</script>