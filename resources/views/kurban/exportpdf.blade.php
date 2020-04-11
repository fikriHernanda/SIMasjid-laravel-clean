<head>
        <meta charset="utf-8">
        <title>Bukti Pendaftaran</title>
        
        <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
        
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        
        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }
        
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        
        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            
            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
        
        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }
        
        .rtl table {
            text-align: right;
        }
        
        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
        </style>
    </head>
    
    <body>
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="{{ route('home') }}/public/dist/assets/img/ibnusina.jpg" style="width:300px;">
                                </td>
                                
                                <td>
                                    Bukti Pendaftaran Kurban <br>
                                Tanggal Pendaftaran: <br>
                                {{date('d-m-Y', strtotime($pekurban->created_at))}}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="information">
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>
                                   Masjid Ibnu Sina<br>
                                    Jalan Veteran No. 122<br>
                                   Malang, 65431
                                </td>
                                
                                <td>
                                    {{$pekurban->nama}}<br>
                                    {{$pekurban->no_hp}}<br>
                                    {{$pekurban->alamat}}<br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr class="heading">
                    <td>
                        Detail Kurban
                    </td>
                    
                    <td>
                        Harga
                    </td>
                </tr>
                
                <tr class="details">
                    <td>
                        {{$pekurban->kurban->jenis_kurban->jenis}} Kategori {{$pekurban->kurban->kelas_kurban->kelas}}
                    </td>
                    
                    <td>
                        @if($pekurban->patungan == 'true')
                            @if($pekurban->harga_aktual !=0)
                            Rp{{number_format(($pekurban->harga_aktual))}}
                            @else 
                            Rp {{number_format(($pekurban->kurban->harga/7))}}
                            <br>Harga Aktual Belum Didefinisikan
                            @endif
                        @elseif($pekurban->harga_aktual == 0)
                            Rp {{number_format($pekurban->kurban->harga)}}
                            <br>Harga Aktual Belum Didefinisikan
                        @elseif($pekurban->harga_aktual != 0) 
                        Rp {{number_format($pekurban->harga_aktual)}}
                        @endif            
                    </td>
                </tr>
                
                <tr class="heading">
                    <td>
                        Permintaan Bagian
                    </td>
                    
                   
                </tr>
                
                <tr class="item">
                    <td>
                        {{$pekurban->bagian_kurban->bagian}}
                    </td>
                    
                    
                </tr>
            </table>
            <table style="height: 155px; margin-left: auto; margin-right: auto;"  width="711">
                    <tbody>
                    <tr style="height: 155px;">
                    <td style="width: 229px; height: 155px;">
                    <p>Pekurban</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                   
                    <hr />
                    </td>
                    <td style="width: 230px; height: 155px;">
                    <p style="float:left;">Malang,</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <hr />
                    </td>
                    </tr>
                    </tbody>
            </table>
        </div>
    </body>
    </html>