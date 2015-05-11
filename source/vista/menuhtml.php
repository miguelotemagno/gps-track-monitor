<?php
  echo '<form  id="testform" method="post" action="">
                          <label for="dp-normal-1">Fecha :</label>
                          <p class="lastup">
                            <input name="dp-normal-1" type="text" class="w8em format-d-m-y divider-dash highlight-days-67 split-dat" id="dp-normal-1" value=""/>
                          </p>
                          <p class="lastup">
                          <label>Hora desde<br/>
                            <div id="timepicker">
                            </div>
                          </label>
                          <p></p>
                          <p class="lastup"> <br />
                            <br />
                            <br />
                            <input name="Submit" type="button" value=":: CONSULTAR ::" onclick="getnewload();" />
                          </p>
                          <p class="lastup">
                            <label>
                              Tiempo de Refresco
                                <select name="delay" id="delay" onclick="cambiartiempo(this.selectedIndex);">
                                <option>0.0</option>
                                <option>0.2</option>
                                <option>0.5</option>
                                <option>0.7</option>
                                <option >1.0</option>
                                <option>1.5</option>
                                <option selected="selected">2.0</option>
                                <option>2.5</option>
                                <option>3.0</option>
                                <option>6.0</option>
                              </select>
                            </label>
                          </p>
        </form>
</div>';
?>
