<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link collapsed">
      <i class="bi bi-clock"></i>
      <span id="current-time" class="d-block ps-2"></span>

    </a>
  </li><!-- End Dashboard Nav -->

  <!-- DASBOR NQR QA -->
  <?php
  $current_url = basename($_SERVER['PHP_SELF']);
  $is_collapsed = ($current_url != 'dasbor.php') ? 'collapsed' : '';
  ?>

  <li class="nav-heading"><?php echo $_SESSION['dept']; ?></li>
  <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'OPQA' || $_SESSION['role'] == 'FMQA' || $_SESSION['role'] == 'SPVQA' || $_SESSION['role'] == 'MGRQA' || $_SESSION['role'] == 'admin')): ?>
    <li class="nav-item">
      <a class="nav-link <?php echo $is_collapsed; ?>" href="../../nqr/qa/dasbor.php">
        <i class="bi bi-grid-1x2"></i>
        <span>NQR</span>
      </a>
    </li><!-- End NQR Nav -->
  <?php endif; ?>

  <!-- DASBOR NQR PPC -->
  <?php
  $current_url = basename($_SERVER['PHP_SELF']);
  $is_collapsed = ($current_url != 'dasborppc.php') ? 'collapsed' : '';
  ?>

  <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'OPPPC' || $_SESSION['role'] == 'FMPPC' || $_SESSION['role'] == 'SPVPPC' || $_SESSION['role'] == 'MGRPPC' || $_SESSION['role'] == 'admin')): ?>
    <li class="nav-item">
      <a class="nav-link <?php echo $is_collapsed; ?>" href="../../nqr/ppc/dasborppc.php">
        <i class="bi bi-grid-1x2"></i>
        <span>NQR</span>
      </a>
    </li><!-- End NQR Nav -->
  <?php endif; ?>

  <!-- DASBOR NQR VDD -->
  <?php
  $current_url = basename($_SERVER['PHP_SELF']);
  $is_collapsed = ($current_url != 'dasbor-vdd.php') ? 'collapsed' : '';
  ?>
  <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'OPVDD' || $_SESSION['role'] == 'FMVDD' || $_SESSION['role'] == 'SPVVDD' || $_SESSION['role'] == 'MGRVDD' || $_SESSION['role'] == 'admin')): ?>
    <li class="nav-item">
      <a class="nav-link <?php echo $is_collapsed; ?>" href="../../nqr/vdd/dasbor-vdd.php">
        <i class="bi bi-grid-1x2"></i>
        <span>NQR</span>
      </a>
    </li><!-- End Dashboard Nav -->
  <?php endif; ?>

  <!-- DASBOR CMR QA -->
  <?php
  $current_url = basename($_SERVER['PHP_SELF']);
  $is_collapsed = ($current_url != 'dasborcmr.php') ? 'collapsed' : '';
  ?>
  <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'OPQA' || $_SESSION['role'] == 'FMQA' || $_SESSION['role'] == 'SPVQA' || $_SESSION['role'] == 'MGRQA' || $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'BODTA')): ?>
    <li class="nav-item">
      <a class="nav-link <?php echo $is_collapsed; ?>" href="../../cmr/qa/dasborcmr.php">
        <i class="bi bi-grid-1x2"></i>
        <span>CMR</span>
      </a>
    </li><!-- End Dashboard Nav -->
  <?php endif; ?>

  <!-- DASBOR CMR PPC -->
  <?php
  $current_url = basename($_SERVER['PHP_SELF']);
  $is_collapsed = ($current_url != 'dasborcmr_ppc.php') ? 'collapsed' : '';
  ?>
  <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'OPPPC' || $_SESSION['role'] == 'FMPPC' || $_SESSION['role'] == 'SPVPPC' || $_SESSION['role'] == 'MGRPPC' || $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'TA')): ?>
    <li class="nav-item">
      <a class="nav-link <?php echo $is_collapsed; ?>" href="../../cmr/ppc/dasborcmr_ppc.php">
        <i class="bi bi-grid-1x2"></i>
        <span>CMR</span>
      </a>
    </li><!-- End Dashboard Nav -->
  <?php endif; ?>

  <!-- DASBOR CMR VDD -->
  <?php
  $current_url = basename($_SERVER['PHP_SELF']);
  $is_collapsed = ($current_url != 'dasborcmr_vdd.php') ? 'collapsed' : '';
  ?>
  <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'OPVDD' || $_SESSION['role'] == 'FMVDD' || $_SESSION['role'] == 'SPVVDD' || $_SESSION['role'] == 'MGRVDD' || $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'TA')): ?>
    <li class="nav-item">
      <a class="nav-link <?php echo $is_collapsed; ?>" href="../../cmr/vdd/dasborcmr_vdd.php">
        <i class="bi bi-grid-1x2"></i>
        <span>CMR</span>
      </a>
    </li><!-- End Dashboard Nav -->
  <?php endif; ?>

  <!-- DASBOR CMR VDD -->
  <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'OPQA' || $_SESSION['role'] == 'FMQA' || $_SESSION['role'] == 'admin')): ?>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#create-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-pencil"></i><span>Create a Report</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
    <?php endif; ?>
    <ul id="create-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <a href="../../nqr/qa/buat-nqr-qa.php">
          <i class="bi bi-circle"></i><span>Create NQR</span>
        </a>
      </li>
      <li>
        <a href="../../cmr/qa/buat-cmr-qa.php">
          <i class="bi bi-circle"></i><span>Create CMR</span>
        </a>
      </li>
    </ul>
  </li><!-- End Components Nav -->

  <?php
  $current_url = basename($_SERVER['PHP_SELF']);
  $is_collapsed = ($current_url != 'ta.php') ? 'collapsed' : '';
  ?>
  <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'BODTA')): ?>
    <li class="nav-item">
      <a class="nav-link <?php echo $is_collapsed; ?>" href="../../cmr/ta/ta.php">
        <i class="bi bi-grid-1x2"></i>
        <span>Check CMR</span>
      </a>
    </li><!-- End Dashboard Nav -->
  <?php endif; ?>


  <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'FMQA' || $_SESSION['role'] == 'SPVQA' || $_SESSION['role'] == 'MGRQA' || $_SESSION['role'] == 'admin'): ?>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-ui-checks"></i><span>Approved</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
    <?php endif; ?>
    <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <li>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'SPVQA' || $_SESSION['role'] == 'FMQA' || $_SESSION['role'] == 'admin'): ?>
          <a href="../../nqr/qa/ap-fm.php">
            <i class="bi bi-circle"></i><span>Approved by FM</span>
          </a>
        <?php endif; ?>
      </li>
      <li>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'SPVQA' || $_SESSION['role'] == 'MGRQA' || $_SESSION['role'] == 'admin'): ?>
          <a href="../../nqr/qa/ap-spv.php">
            <i class="bi bi-circle"></i><span>Approved by SPV</span>
          </a>
        </li>
      <?php endif; ?>

      <li>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'MGRQA' || $_SESSION['role'] == 'admin'): ?>
          <a href="../../nqr/qa/ap-mgr.php">
            <i class="bi bi-circle"></i><span>Approved by Manager</span>
          </a>
        </li>
      <?php endif; ?>


    </ul>
  </li><!-- End Components Nav -->


  <!-- PPC -->
  <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'FMPPC' || $_SESSION['role'] == 'SPVPPC' || $_SESSION['role'] == 'MGRPPC' || $_SESSION['role'] == 'admin'): ?>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#ppc-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-ui-checks"></i><span>Approved</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
    <?php endif; ?>
    <ul id="ppc-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'SPVPPC' || $_SESSION['role'] == 'FMPPC' || $_SESSION['role'] == 'admin'): ?>
        <li>
          <a href="../../nqr/ppc/ap-fm-ppc.php">
            <i class="bi bi-circle"></i><span>Approved by FM</span>
          </a>
        </li>
      <?php endif; ?>
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'SPVPPC' || $_SESSION['role'] == 'MGRPPC' || $_SESSION['role'] == 'admin'): ?>
        <li>
          <a href="../../nqr/ppc/ap-spv-ppc.php">
            <i class="bi bi-circle"></i><span>Approved by SPV</span>
          </a>
        </li>
      <?php endif; ?>

      <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'MGRPPC' || $_SESSION['role'] == 'admin'): ?>
        <li>
          <a href="../../nqr/ppc/ap-mgr-ppc.php">
            <i class="bi bi-circle"></i><span>Approved by Manager</span>
          </a>
        </li>
      <?php endif; ?>


    </ul>
  </li><!-- End Components Nav -->

  <!-- VDD -->
  <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'FMVDD' || $_SESSION['role'] == 'SPVVDD' || $_SESSION['role'] == 'MGRVDD' || $_SESSION['role'] == 'admin'): ?>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#vdd-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-ui-checks"></i><span>Approved</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
    <?php endif; ?>
    <ul id="vdd-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'SPVVDD' || $_SESSION['role'] == 'FMVDD' || $_SESSION['role'] == 'admin'): ?>
        <li>
          <a href="../../nqr/vdd/ap-fm-vdd.php">
            <i class="bi bi-circle"></i><span>Approved by FM</span>
          </a>
        </li>
      <?php endif; ?>
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'SPVVDD' || $_SESSION['role'] == 'MGRVDD' || $_SESSION['role'] == 'admin'): ?>
        <li>
          <a href="../../nqr/vdd/ap-spv-vdd.php">
            <i class="bi bi-circle"></i><span>Approved by SPV</span>
          </a>
        </li>
      <?php endif; ?>

      <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'MGRVDD' || $_SESSION['role'] == 'admin'): ?>
        <li>
          <a href="../../nqr/vdd/ap-mgr-vdd.php">
            <i class="bi bi-circle"></i><span>Approved by Manager</span>
          </a>
        </li>
      <?php endif; ?>


    </ul>
  </li><!-- End Components Nav -->

  <!-- DOWNLOAD REPORT -->
  <?php
  $current_url = basename($_SERVER['PHP_SELF']);
  $is_collapsed = ($current_url != 'donlodnqr.php' && $current_url != 'donlodcmr.php') ? 'collapsed' : '';
  ?>
  <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == 'OPVDD' || $_SESSION['role'] == 'FMVDD' || $_SESSION['role'] == 'SPVVDD' || $_SESSION['role'] == 'MGRVDD' || $_SESSION['role'] == 'admin')): ?>
    <li class="nav-item">
      <a class="nav-link <?php echo $is_collapsed; ?>" href="../../nqr/vdd/donlodnqr.php">
        <i class="ri-folder-download-line"></i>
        <span>Download PDF</span>
      </a>
    </li><!-- End Dashboard Nav -->
  <?php endif; ?>


  <li class="nav-heading">Pages</li>

  <!-- REMINDER REPORT -->
  <?php
  $current_url = basename($_SERVER['PHP_SELF']);
  $is_collapsed = ($current_url != 'notif.php' && $current_url != 'notifcmr.php') ? 'collapsed' : '';
  ?>
  <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'OPQA' || $_SESSION['role'] == 'OPPPC' || $_SESSION['role'] == 'OPVDD' || $_SESSION['role'] == 'admin'): ?>
    <li class="nav-item">
      <a class="nav-link <?php echo $is_collapsed; ?>" href="../../nqr/qa/notif.php">
        <i class="bi bi-bell"></i>
        <span>Reminder</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->
  <?php endif; ?>

  <!-- FAQ -->
  <?php
  $current_url = basename($_SERVER['PHP_SELF']);
  $is_collapsed = ($current_url != 'faq.php') ? 'collapsed' : '';
  ?>
  <li class="nav-item">
    <a class="nav-link <?php echo $is_collapsed; ?>" href="faq.php">
      <i class="bi bi-question-circle"></i>
      <span>F.A.Q</span>
    </a>
  </li><!-- End F.A.Q Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="../../../view/logout.php" id="logoutButton">
      <i class="ri-logout-circle-line"></i>
      <span>Log Out</span>
    </a>
  </li><!-- End Login Page Nav -->

  <!-- Pastikan Anda menyertakan Sweet Alert library -->
  <script src="asset/sweetalert2/sweet.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Ambil elemen tombol logout
      var logoutButton = document.getElementById('logoutButton');

      // Pengecekan apakah elemen logout ditemukan
      if (logoutButton) {
        // Tambahkan event listener untuk saat tombol logout diklik
        logoutButton.addEventListener("click", function (event) {
          // Menghentikan perilaku default dari link
          event.preventDefault();

          // Tampilkan Sweet Alert
          Swal.fire({
            title: 'Apakah Anda yakin untuk logout?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout!',
            cancelButtonText: 'Batal'
          }).then((result) => {
            // Jika tombol 'Ya, Logout!' diklik
            if (result.isConfirmed) {
              // Redirect ke halaman logout
              window.location.href = logoutButton.getAttribute('href');
            }
          });
        });
      } else {
        console.error("Tombol logout tidak ditemukan!");
      }
    });
  </script>




  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="dasborppc.php">
      <i class="bi bi-grid"></i>
      <span>Dashboardppc</span>
    </a>
  </li>End Dashboard Nav -->


</ul>