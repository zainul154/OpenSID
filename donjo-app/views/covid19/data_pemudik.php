<style>
	.input-sm
	{
		padding: 4px 4px;
	}
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Data Pemudik Saat Pandemi Covid-19</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('hom_sid')?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Data Pemudik</li>
		</ol>
	</section>
	
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?= site_url("covid19/form_pemudik")?>" title="Tambah Data Warga" class="btn btn-social btn-flat bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-plus"></i> Tambah Warga Pemudik</a>
						<a href="<?= site_url("covid19/unduhsheet")?>" class="btn btn-social btn-flat bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Unduh Data" target="_blank"><i class="fa  fa-download"></i> Unduh</a>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<tbody>
											<tr>
												<td style="padding-top : 10px;padding-bottom : 10px;width:20%;" >Nama Data</td>
												<td> : Covid-19</td>
											</tr>
											<tr>
												<td style="padding-top : 10px;padding-bottom : 10px;" >Sasaran Terdata</td>
												<td> : Penduduk</td>
											</tr>
											<tr>
												<td style="padding-top : 10px;padding-bottom : 10px;" >Keterangan</td>
												<td> : Pemudik</td>
											</tr>
										</tbody>
									</table>
								</div>

								<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
									<form id="mainform" name="mainform" action="" method="post">
										<div class="row">
											<div class="col-sm-12">
												<div class="table-responsive">
													<table class="table table-bordered dataTable table-striped table-hover">
														<thead class="bg-gray disabled color-palette">
															<tr>
																<th>No</th>
																<th>Aksi</th>
																<th>NIK</th>
																<th>Nama</th>
																<th>Usia</th>
																<th>JK</th>
																<th>Alamat</th>
																<th>Asal Pemudik</th>
																<th>Tanggal Tiba</th>
																<th>Tujuan Pemudik</th>
																<th>Kontak</th>
																<th>Status</th>
																<th>Keluhan</th>
															</tr>
														</thead>
														<tbody>
															<?php
																$nomer = $paging->offset;
																if (is_array($terdata)):
																	foreach ($terdata as $key=>$item):
																		$nomer++;
															?>
																<tr>
																	<td align="center" width="2"><?= $nomer; ?></td>
																	<td nowrap>
																		<?php if ($this->CI->cek_hak_akses('h')): ?>
																			<a href="<?= site_url("covid19/edit_pemudik_form/$item[id]")?>" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Ubah Data Pemudik" title="Ubah Data Pemudik" class="btn btn-warning btn-flat btn-sm"><i class="fa fa-edit"></i></a>
																			<a href="#" data-href="<?= site_url("covid19/hapus_pemudik/$item[id]")?>" class="btn bg-maroon btn-flat btn-sm" title="Hapus Data" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
																		<?php endif; ?>
																	</td>
																	<td><?= $item["terdata_nama"] ?></td>
																	<td nowrap><a href="<?= site_url('covid19/detil_pemudik/'.$item["id"])?>" title="Data terdata"><?= $item['terdata_info'];?></a></td>
																	<td><?= $item["umur"] ?></td>
																	<?php
																	$jk = (strtoupper($item['sex']) === "PEREMPUAN") ? "Pr" : "Lk"; 
																	?>
																	<td><?= $jk?></td>
																	<td><?= $item["info"];?></td>
																	<td><?= $item["asal_mudik"];?></td>
																	<td><?= $item["tanggal_datang"];?></td>
																	<td><?= $item["tujuan_mudik"];?></td>
																	<td><?= $item["no_hp"];?> - <?= $item["email"];?> </td>
																	<td><?= $item["status_covid"];?></td>
																	<td><?= $item["keluhan_kesehatan"];?></td>
																</tr>
																	<?php
																	endforeach;
																endif;
															?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</form>
									<div class="row">
										<div class="col-sm-6">
											<div class="dataTables_length">
												<form id="paging" action="" method="post" class="form-horizontal">
													<label>
														Tampilkan
														<select name="per_page" class="form-control input-sm" onchange="$('#paging').submit()">
															<option value="10" <?php selected($per_page,10); ?> >10</option>
															<option value="100" <?php selected($per_page,100); ?> >100</option>
															<option value="200" <?php selected($per_page,200); ?> >200</option>
														</select>
														Dari
														<strong><?= $paging->num_rows?></strong>
														Total Data
													</label>
												</form>
											</div>
										</div>
										<div class="col-sm-6">
					                      	<div class="dataTables_paginate paging_simple_numbers">
					                        	<ul class="pagination">
				                        		<?php if ($paging->start_link): ?>
						                            <li>
						                            	<a href="<?=site_url('covid19/data_pemudik/'.$paging->start_link)?>" aria-label="First"><span aria-hidden="true">Awal</span></a>
						                            </li>
					                          	<?php endif; ?>

					                          	<?php if ($paging->prev): ?>
						                            <li>
						                            	<a href="<?=site_url('covid19/data_pemudik/'.$paging->prev)?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
						                            </li>
					                          	<?php endif; ?>

					                          	<?php for ($i=$paging->start_link;$i<=$paging->end_link;$i++): ?>
						               	            <li <?=jecho($p, $i, "class='active'")?>>
						               	            	<a href="<?= site_url('covid19/data_pemudik/'.$i)?>"><?= $i?></a>
					               	            	</li>
					                          	<?php endfor; ?>

					                          	<?php if ($paging->next): ?>
						                            <li>
						                            	<a href="<?=site_url('covid19/data_pemudik/'.$paging->next)?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
						                            </li>
					                          	<?php endif; ?>

					                          	<?php if ($paging->end_link): ?>
						                            <li>
						                            	<a href="<?=site_url('covid19/data_pemudik/'.$paging->end_link)?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a>
						                            </li>
					                          	<?php endif; ?>
					                         
					                        	</ul>
					                     	 </div>
                    					</div>
                					</div>
                				</div>
                			</div>
                		</div>
                	</div>
				</div>
			</div>
		</div>
	</section>
</div>


<!-- MODAL DIALOG -->
<div class='modal fade' id='confirm-delete' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				<h4 class='modal-title' id='myModalLabel'><i class='fa fa-exclamation-triangle text-red'></i> Konfirmasi</h4>
			</div>
			<div class='modal-body btn-info'>
				Apakah Anda yakin ingin menghapus data ini?
			</div>
			<div class='modal-footer'>
				<button type="button" class="btn btn-social btn-flat btn-warning btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
				<a class='btn-ok'>
					<button type="button" class="btn btn-social btn-flat btn-danger btn-sm" id="ok-delete"><i class='fa fa-trash-o'></i> Hapus</button>
				</a>
			</div>
		</div>
	</div>
</div>

<div  class="modal fade" id="modalBox" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				<h4 class='modal-title' id='myModalLabel'></h4>
			</div>
			<div class="fetched-data"></div>
		</div>
	</div>
</div>

						<!--
						
						<div class='modal fade' id='confirm-status' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
							<div class='modal-dialog'>
								<div class='modal-content'>
									<div class='modal-header'>
										<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
										<h4 class='modal-title' id='myModalLabel'><i class='fa fa-exclamation-triangle text-red'></i> Konfirmasi</h4>
									</div>
									<div class='modal-body btn-info'>
										Apakah Anda yakin ingin memecah Data Keluarga ini?
									</div>
									<div class='modal-footer'>
										<button type="button" class="btn btn-social btn-flat btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
										<a class='btn-ok'>
											<button type="button" class="btn btn-social btn-flat btn-info btn-sm" id="ok-delete"><i class='fa fa-check'></i> Simpan</button>
										</a>
									</div>
								</div>
							</div>
						</div>
						-->

