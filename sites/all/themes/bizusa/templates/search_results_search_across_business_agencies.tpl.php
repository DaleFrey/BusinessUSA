  <?php
      $searchUsaApiReturn = apiSearchUSA($variables['search']); // NOTE: apiSearchUSA() is defiend in SearchUSA-API.php
      $searchUsaResults = $searchUsaApiReturn['results'];
  ?>
  
  <?php if ( empty($_REQUEST['page']) || $_REQUEST['page'] == NULL ): /* if this is the first page... */ ?>
  
      <div class="search-acrossbusinessagencies-mastercontainer search-acrossbusinessagencies-resultcounttotal-<?php print intval($searchUsaApiReturn['total']); ?>">
        <div class="search-acrossbusinessagencies-innercontainer">
            <div class="search-acrossbusinessagencies-title">
                <a href="/searchusa?search=<?php print $variables['search']; ?>">
                    Search Results for "<?php print $variables['search']; ?>" Across Business Agencies
                </a>
            </div>
            <div class="search-acrossbusinessagencies-results-container">
                <?php
                    $searchUsaRenderCount = 0;
                    foreach ( $searchUsaResults as $searchUsaResult ) { 
                    
                        $searchUsaRenderCount++;
                        if ( $searchUsaRenderCount > 3 ) { break; } // Dont show any more than 3 results from SearchUSA
                ?>
                
                        <div class="search-acrossbusinessagencies-result-container">
                            <div class="search-acrossbusinessagencies-result-titlelinked">
                                <a href="<?php print $searchUsaResult['unescapedUrl']; ?>">
                                    <?php print $searchUsaResult['title']; ?>
                                </a>
                            </div>
                            <div class="search-acrossbusinessagencies-result-snippet">
                                <?php print $searchUsaResult['content']; ?>
                            </div>
                        </div>
                        
                <?php 
                    }
                ?>
            </div>
        </div>
      </div>
  
  <?php endif; ?>