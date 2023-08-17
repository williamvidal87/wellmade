<div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel">

                <div class="panel_body">

                    @foreach($viewdata as $data)

                        <?php
                            $result = strval($data->id);
                        ?>
                        <p>{{ $data->name }}</p>
                        <div class="center" style="width:50px;">
                            {!! DNS2D::getBarcodeHTML($result, 'QRCODE', 3,3) !!}
                        </div>
                        <br>
                        
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>