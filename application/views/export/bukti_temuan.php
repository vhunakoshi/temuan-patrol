<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title_pdf;?></title>
        <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/adminlte.css">
        <style>
          @page {
                margin: 0cm 0cm;
            }

          /** Define now the real margins of every page in the PDF **/
          body {
              margin-top: 4cm;
              margin-left: 1.5cm;
              margin-right: 1cm;
              margin-bottom: 1cm;
          }

          /** Define the header rules **/
          header {
              position: fixed;
              top: 0.5cm;
              left: 1cm;
              right: 1cm;
              height: 3.5cm;
          }

          /** Define the footer rules **/
          footer {
              position: fixed; 
              bottom: 0cm; 
              left: 0cm; 
              right: 0cm;
              height: 2cm;
          }

          .borderless td, .borderless th {
              border: none;
          }
        </style>
    </head>
    <body>
      <header>
        <table> 
          <tr>
            <td><img src="<?= base_url('assets'); ?>/img/toto.png" alt="toto" width="150" height="75"></td>
            <td class="text-center mt-2">
              <h5 class="mb-1">TEMUAN PATROL MANAGEMENT</h5>
              <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, voluptate!</span>
            </td>
            <td class="text-right"><img src="<?= base_url('assets'); ?>/img/logo.png" alt="k3" width="100" height="100"></td>
          </tr>
        </table>
      </header>

      <footer>
        <script type="text/php">
          if ( isset($pdf) ) { 
            $pdf->page_script('
                if ($PAGE_COUNT > 1) {
                  $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                  $size = 12;
                  $pageText = "Page " . $PAGE_NUM . " of " . $PAGE_COUNT;
                  $y = 800;
                  $x = 500;
                  $pdf->text($x, $y, $pageText, $font, $size);
                } 
            ');
          }
        </script>
      </footer>
      <main>
        <div class="text-center mb-4">
          <h3>Laporan Bukti Temuan</h3>
        </div>

        <div>
          <table class="table borderless">
            <tr>
              <th width="10">Nama Tim</th>
              <td width="5">:</td>
              <td width="35"><?= $jadwal['nama_tim'] ?></td>
              <th width="10">Zona Patrol</th>
              <td width="5">:</td>
              <td width="35"><?= $jadwal['nama_zona'] ?></td>
            </tr>
            <tr>
              <th width="10">Tanggal</th>
              <td width="5">:</td>
              <td width="35"><?= $jadwal['tgl_patrol'] ?></td>
              <th width="10">Status</th>
              <td width="5">:</td>
              <td width="35"><?= $jadwal['status'] ?></td>
            </tr>
          </table>
        </div>

        <table id="table" class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Temuan</th>
                    <th class="text-center">Kategori</th>
                </tr>
            </thead>
            <tbody>
              <?php if($bukti_temuan) : ?>
                <?php foreach($bukti_temuan as $key => $item) : ?>
                  <tr>
                      <td scope="row"><?= $key + 1?></td>
                      <td>
                        <img height="150" src="http://temuanpatrol.test/assets/img/temuan_patrol/<?= $item['foto_temuan']?>" alt="" class="mb-3"><br/>
                        <table class='table borderless'>
                          <tr>
                            <th width="20%">Nama Seksi</th>
                            <td width="10%">:</td>
                            <td width="70%"><?= $item['nama_seksi']?></td>
                          </tr>
                          <tr>
                            <th>Keterangan</th>
                            <td>:</td>
                            <td><?= $item['uraian_temuan']?></td>
                          </tr>
                        </table>
                      </td>
                      <td class="text-center"><?= $item['kategori']?></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
        </table>
      </main>
    </body>
</html>