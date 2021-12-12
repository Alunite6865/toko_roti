<div class="content">
    <div class="container">
        <?php
        if (session()->getFlashdata('pesan')) {
            echo ' <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Sukses!</h5>';
            echo session()->getFlashdata('pesan');
            echo '</div>';
        }
        ?>
        <!-- Main content -->
        <?php echo form_open('home/update'); ?>
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-shopping-basket"></i> Keranjang Belanja
                        <small class="float-right">Date: 2/10/2014</small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="100px">Qty</th>
                                <th>Nama Barang</th>
                                <th>Berat (gr)</th>
                                <th>Total Berat (gr)</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tot_jumlah = 0;
                            $tot_berat = 0;
                            $i = 1;
                            foreach ($cart->contents() as $key => $value) {
                                $tot_jumlah = $tot_jumlah + $value['qty'];
                                $tot_berat = $tot_berat + $value['options']['berat'] * $value['qty'];
                            ?>
                                <tr>
                                    <td><input type="number" min="1" name="qty<?= $i++; ?>" class="form-control" value="<?= $value['qty'] ?>"></td>
                                    <td><?= $value['name'] ?></td>
                                    <td><?= $value['options']['berat'] ?></td>
                                    <td><?= $value['qty'] * $value['options']['berat'] ?></td>
                                    <td><?= number_to_currency($value['price'], 'IDR') ?>,-</td>
                                    <td><?= number_to_currency($value['subtotal'], 'IDR'); ?>,-</td>
                                    <td>
                                        <a href="<?= base_url('home/delete/' . $value['rowid']); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table">
                            <!-- <tr>
                                <th style="width:50%">Subtotal : </th>
                                <td>$250.30</td>
                            </tr>
                            <tr>
                                <th>Tax (9.3%)</th>
                                <td>$10.34</td>
                            </tr> -->
                            <tr>
                                <th>Total Jumlah</th>
                                <td><?= $tot_jumlah ?></td>
                            </tr>
                            <tr>
                                <th>Total Berat</th>
                                <td><?= $tot_berat ?> gram</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td><?= number_to_currency($cart->total(), 'IDR') ?>,-</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                    <a href="<?= base_url('home/clear'); ?>" class="btn btn-warning"><i class="fas fa-trash"></i> Hapus Belanjaan</a>
                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Checkout</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
        <!-- /.invoice -->
    </div>
</div>