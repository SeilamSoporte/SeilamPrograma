<script>
function refresh(){
    $.post('resources/getDate.php','',function(data){

        $('a.btnload').each(function(i){ 
            var link = $(this).attr('link');
            link = link+ data;
            $(this).attr({'href':link});
        });
        
    });
    setTimeout(refresh,5000);
}
refresh();

</script>	
<?php 
$idArray = getdate();
$id      = $idArray['minutes'].$idArray['hours'].$idArray['wday'].$idArray['mon'].$idArray['yday'];
$dd      = $_POST['desde'] ;
$hh      = $_POST['hasta'] ;
$NMB     = $_POST['NMB'] ;
$NFQ     = $_POST['NFQ'] ;
$NVol    = $_POST['NVol'] ;
$NIones  = $_POST['NIones'] ;
$NDC     = $_POST['NDC'] ;
$NA      = $_POST['NA'] ;
$NCH     = $_POST['NCH'] ;

?><div>
	<div class="panel-body btns">
        <div class="row">
            <div class="col col-xs-12">
                <a href="" link="ordendeservicioMB.php?dd=<?php echo $dd?>&hh=<?php echo $hh?>&id=" target="_blank" class="btn btn-primary btnload" role="button">MB Productos <span class="badge"><?php echo $NMB ?></span>
                </a> 
                
                <a href="" link="ordendeservicioMBCH.php?dd=<?php echo $dd?>&hh=<?php echo $hh?>&id=" target="_blank" class="btn btn-primary btnload btn-fq" role="button">MB Control Higiene <span class="badge"><?php echo $NCH ?></span>
                </a>

                <a href="" link="ordendeservicioMBA.php?dd=<?php echo $dd?>&hh=<?php echo $hh?>&id=" target="_blank" class="btn btn-primary btnload" role="button">MB Aguas <span class="badge"><?php echo $NA ?></span>
                </a>

                <a href="" link="ordendeservicioFQ.php?dd=<?php echo $dd?>&hh=<?php echo $hh?>&id=" target="_blank" class="btn btn-primary btnload btn-fq" role="button">Fisicoquímicos Directo <span class="badge"><?php echo $NFQ ?></span>
                </a> 
                <a href="" link="ordendeservicioVol.php?dd=<?php echo $dd?>&hh=<?php echo $hh?>&id=" target="_blank" class="btn btn-primary btnload" role="button">FQ Volumétricos  <span class="badge"><?php echo $NVol ?></span>
                </a> 
                <a href="" link="ordendeservicioIones.php?dd=<?php echo $dd?>&hh=<?php echo $hh?>&id=" target="_blank" class="btn btn-primary btnload" role="button">FQ Iones         <span class="badge"><?php echo $NIones ?></span>
                </a> 
                <a href="" link="ordendeservicioDC.php?dd=<?php echo $dd?>&hh=<?php echo $hh?>&id=" target="_blank" class="btn btn-primary btnload" role="button">Datos en campo    <span class="badge"><?php echo $NDC ?></span>
                </a>
            </div>
    </div>
</div>