<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">MIS Panel v1.0</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $this->session->userdata('MIS_LOGGED_NAME'); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            	<li class="nav-item">
            		<?php
            			$menuDashboard = false;
            			if (strtolower($this->uri->segment(1)) == 'main' || strtolower($this->uri->segment(1)) == '') {
            				$menuDashboard = true;
            			}
            		?>
	                <a href="<?= site_url('Main') ?>" class="nav-link <?= ($menuDashboard ? 'active' : "'") ?>">
	                    <i class="nav-icon fa fa-square"></i>
	                    <p>
	                        Dashboard
	                    </p>
	                </a>
				</li>
	            <li class="nav-item <?= (strtolower($this->uri->segment(1)) == 'basic' ? 'menu-open' : "'") ?>">
	                <a href="#" class="nav-link <?= (strtolower($this->uri->segment(1)) == 'basic' ? 'active' : "'") ?>">
	                    <i class="fa fa-database nav-icon"></i>
	                    <p>
	                        Basic Data
	                        <i class="fas fa-angle-left right"></i>
	                    </p>
	                </a>
	                <ul class="nav nav-treeview">
	                	<!-- <li class="nav-item">
	                    	<?php
	                    		$menuUser = false;
	                    		if (strtolower($this->uri->segment(2)) == 'users') {
	                    			$menuUser = true;
	                    		}
	                    	?>
	                        <a href="<?= base_url('Basic/users') ?>" class="nav-link <?= ($menuUser ? 'active' : '') ?>">
	                            <p class="ml-30">Users</p>
	                        </a>
	                    </li> -->
	                    <li class="nav-item">
	                    	<?php
	                    		$menuInstansi = false;
	                    		if (strtolower($this->uri->segment(2)) == 'sub_instansi' || strtolower($this->uri->segment(2)) == 'instansi') {
	                    			$menuInstansi = true;
	                    		}
	                    	?>
	                        <a href="<?= base_url('Basic/instansi') ?>" class="nav-link <?= ($menuInstansi ? 'active' : '') ?>">
	                            <p class="ml-30">Instansi</p>
	                        </a>
	                    </li>
	                    <li class="nav-item">
	                    	<?php
	                    		$menuTahapanTender = false;
	                    		if (strtolower($this->uri->segment(2)) == 'tahapan_detail' || strtolower($this->uri->segment(2)) == 'tahapan_tender') {
	                    			$menuTahapanTender = true;
	                    		}
	                    	?>
	                        <a href="<?= base_url('Basic/tahapan_tender') ?>" class="nav-link <?= ($menuTahapanTender ? 'active' : '') ?>">
	                            <p class="ml-30">Master Tahapan Tender</p>
	                        </a>
	                    </li>
	                    <li class="nav-item">
	                    	<?php
	                    		$menuInfoPasar = false;
	                    		if (strtolower($this->uri->segment(2)) == 'info_pasar' || strtolower($this->uri->segment(2)) == 'info_pasar_add' || strtolower($this->uri->segment(2)) == 'info_pasar_edit' || $this->uri->segment(2) == 'info_pasar_mpp') {
	                    			$menuInfoPasar = true;
	                    		}
	                    	?>
	                        <a href="<?= base_url('Basic/info_pasar') ?>" class="nav-link <?= ($menuInfoPasar ? 'active' : '') ?>">
	                            <p class="ml-30">Info Pasar</p>
	                        </a>
	                    </li>
	                    <li class="nav-item">
	                    	<?php
	                    		$menuProposal = false;
	                    		if (strtolower($this->uri->segment(2)) == 'proposal' || strtolower($this->uri->segment(2)) == 'proposal_add' || strtolower($this->uri->segment(2)) == 'proposal_edit') {
	                    			$menuProposal = true;
	                    		}
	                    	?>
	                        <a href="<?= base_url('Basic/proposal') ?>" class="nav-link <?= ($menuProposal ? 'active' : '') ?>">
	                            <p class="ml-30">Proposal</p>
	                        </a>
	                    </li>
	                    <li class="nav-item">
	                    	<?php
	                    		$menuJob = false;
	                    		if (strtolower($this->uri->segment(2)) == 'job' || strtolower($this->uri->segment(2)) == 'job_form') {
	                    			$menuJob = true;
	                    		}
	                    	?>
	                        <a href="<?= base_url('Basic/job') ?>" class="nav-link <?= ($menuJob ? 'active' : '') ?>">
	                            <p class="ml-30">Job</p>
	                        </a>
	                    </li>
	                </ul>
	            </li>
	            <li class="nav-item">
	                <a href="#" class="nav-link">
	                    <i class="nav-icon fa fa-edit"></i>
	                    <p>
	                        Entry
	                    </p>
	                    <i class="fas fa-angle-left right"></i>
	                </a>
	                <ul class="nav nav-treeview">
	                	<li class="nav-item">
	                        <a href="<?= base_url('Entry/job') ?>" class="nav-link">
	                            <p class="ml-30">RAP</p>
	                        </a>
	                    </li>
	                    <li class="nav-item">
	                        <a href="<?= base_url('Entry/job') ?>" class="nav-link">
	                            <p class="ml-30">PD Pratender</p>
	                        </a>
	                    </li>
	                </ul>
				</li>
				 <li class="nav-item">
	                <a href="#" class="nav-link">
	                    <i class="nav-icon fa fa-book"></i>
	                    <p>
	                        Report
	                    </p>
	                    <i class="fas fa-angle-left right"></i>
	                </a>
	                <ul class="nav nav-treeview">
	                    <li class="nav-item">
	                        <a href="<?= base_url('Report/job') ?>" class="nav-link">
	                            <p class="ml-30">Query PD/PJ</p>
	                        </a>
	                    </li>
	                     <li class="nav-item">
	                        <a href="<?= base_url('Report/job') ?>" class="nav-link">
	                            <p class="ml-30">Outstanding PD Pratender</p>
	                        </a>
	                    </li>
	                </ul>
				</li>
	        </ul>
	    </nav>
	</div>
</aside>