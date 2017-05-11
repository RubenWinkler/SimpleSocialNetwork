<?php if (isset($_SESSION["username"]) || isCookieValid($db)): ?>
<div class="container-fluid" id="chronik-filter-button-container">
  <div class="col-xs-12" id="chronik-filter-button-cell">
    <a class="btn btn-default btn-xs" id="chronik-filter-button" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      Sortieren nach: <span class="caret"></span>
    </a>
    <div class="collapse" id="collapseExample">
      <div class="well" id="filter-optionen-well">
        <form>
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-3">
                <span class="filter-header">Videogenre</span>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Gaming</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Vlog</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Lifestyle</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Beauty</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Essen & Trinken</label>
                </div>
              </div>
              <div class="col-xs-3">
                <span class="filter-header">Game</span>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 1</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 2</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 3</label>
                </div>
              </div>
              <div class="col-xs-3">
                <span class="filter-header">Videogenre</span>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 1</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 2</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 3</label>
                </div>
              </div>
              <div class="col-xs-3">
                <span class="filter-header">Videogenre</span>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 1</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 2</label>
                </div>
                <div class="checkbox">
                  <label><input type="checkbox" value="">Option 3</label>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endif ?>
