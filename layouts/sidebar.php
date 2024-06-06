<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <div class="user">
        <div class="avatar-sm float-left mr-2">
					<img src="../assets/img/profile.jpg" alt="" class="avatar-img rounded-circle">
        </div>
        <div class="info">
          <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
						<span>
							<?php echo $_SESSION['nama']; ?>
							<span class="user-level"><?php echo ucfirst($_SESSION['level']); ?></span>
						</span>
					</a>
					<div class="clearfix"></div>
        </div>
      </div>
      <ul class="nav nav-primary">
        <li class="nav-item">
					<a href="index.php?p=dashboard">
						<i class="fas fa-home"></i>
						<p>Dashboard</p>
					</a>
        </li>
        <!-- //* Administrator -->
        <?php
          if ($_SESSION['level'] == 'administrator') {
        ?>
        <li class="nav-section">
					<span class="sidebar-mini-icon">
						<i class="fa fa-ellipsis-h"></i>
					</span>
					<h4 class="text-section">Administrator</h4>
        </li>
        <li class="nav-item">
					<a href="index.php?p=pengguna">
						<i class="fas fa-user"></i>
						<p>Master Pengguna</p>
					</a>
        </li>
        <li class="nav-item">
					<a href="index.php?p=master-penyuluhan">
						<i class="fas fa-swatchbook"></i>
						<p>Master Penyuluhan</p>
					</a>
        </li>
        <li class="nav-item">
					<a href="index.php?p=master-tindakan">
						<i class="fas fa-syringe"></i>
						<p>Master Tindakan</p>
					</a>
        </li>
        <!-- //* Kader -->
        <?php
          }
          if ($_SESSION['level'] == 'administrator' || $_SESSION['level'] == 'kader') {
        ?>
        <li class="nav-section">
					<span class="sidebar-mini-icon">
						<i class="fa fa-ellipsis-h"></i>
					</span>
					<h4 class="text-section">Kader</h4>
        </li>
        <li class="nav-item">
					<a data-toggle="collapse" href="#pendaftaran">
						<i class="fas fa-th-list"></i>
						<p>Meja 1</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="pendaftaran">
						<ul class="nav nav-collapse">
							<li>
								<a href="index.php?p=klien">
									<span class="sub-item">Klien</span>
								</a>
              </li>
              <li>
								<a href="index.php?p=posyandu">
									<span class="sub-item">Pendaftaran Posyandu</span>
								</a>
							</li>
						</ul>
					</div>
        </li>
        <li class="nav-item">
					<a data-toggle="collapse" href="#penimbangan">
						<i class="fas fa-th-list"></i>
						<p>Meja 2</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="penimbangan">
						<ul class="nav nav-collapse">
							<li>
								<a href="index.php?p=penimbangan">
									<span class="sub-item">Penimbangan Posyandu</span>
								</a>
							</li>
						</ul>
					</div>
        </li>
        <li class="nav-item">
					<a data-toggle="collapse" href="#bmi">
						<i class="fas fa-th-list"></i>
						<p>Meja 3</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="bmi">
						<ul class="nav nav-collapse">
							<li>
								<a href="index.php?p=interprestasi">
									<span class="sub-item">Interprestasi</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
        <li class="nav-item">
					<a data-toggle="collapse" href="#penyuluhan">
						<i class="fas fa-th-list"></i>
						<p>Meja 4</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="penyuluhan">
						<ul class="nav nav-collapse">
							<li>
								<a href="index.php?p=penyuluhan-posyandu">
									<span class="sub-item">Penyuluhan Posyandu</span>
								</a>
							</li>
						</ul>
					</div>
        </li>
        <li class="nav-item">
					<a data-toggle="collapse" href="#tindakan">
						<i class="fas fa-th-list"></i>
						<p>Meja 5</p>
						<span class="caret"></span>
					</a>
					<div class="collapse" id="tindakan">
						<ul class="nav nav-collapse">
							<li>
								<a href="index.php?p=tindakan-posyandu">
									<span class="sub-item">Tindakan Posyandu</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
        <li class="nav-section">
					<span class="sidebar-mini-icon">
						<i class="fa fa-ellipsis-h"></i>
					</span>
					<h4 class="text-section">Laporan</h4>
        </li>
        <li class="nav-item">
					<a href="index.php?p=laporan">
						<i class="fas fa-archive"></i>
						<p>Laporan Posyandu</p>
					</a>
        </li>
        <?php
          }
        ?>
      </ul>
    </div>
  </div>
</div>