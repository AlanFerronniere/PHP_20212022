<?php

namespace Geometrie;

class GenerateurCanvas
{
    private $figures;
    private int $width;
    private int $height;
    private string $id;

    public function __construct(int $w, int $h)
    {
        $this->height = $h;
        $this->width = $w;
        $this->id=uniqid();
    }

    public function AjouterFigure(IFigure $f)
    {
        $this->figures[] = $f;
    }

    public function GenererHTMLEtJS()
    {
        ?>
        <canvas id='<?php echo $this->id ?>' width='<?php echo $this->width ?>' height='<?php echo $this->height ?>'></canvas>
        <script type="text/javascript">
            var canvas_<?php echo $this->id ?>=document.getElementById("<?php echo $this->id ?>");
            var ctx_<?php echo $this->id ?> = canvas_<?php echo $this->id ?>.getContext("2d");

            ctx_<?php echo $this->id ?>.fillStyle="#0f0";

            <?php
                foreach ($this->figures as $f){
                    $f->GenererJS("ctx_".$this->id);
                }
            ?>
        </script>
        <?php
    }

    public function GenererTableauAireEtPerimetre(){
        ?>
        <table border="1">
            <tr>
                <th>Figure</th>
                <th>Périmètre</th>
                <th>Aire</th>
            </tr>
            <?php
            foreach ($this->figures as $f){
                ?>
                <tr>
                    <td><?php echo $f ?></td>
                    <td><?php echo $f->CalculerPerimetre() ?></td>
                    <td><?php echo $f->CalculerAire() ?></td>
                </tr>
                <?php
            }
            ?>
        </table>

        <?php
    }
}