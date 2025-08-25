<?php 
    $mytime = getdate(date("U"));
    $date = "$mytime[weekday], $mytime[month] $mytime[mday], $mytime[year]";

   require "db.inc.php";
    $sql = $conn->query("SELECT id FROM rate");
    $numR = $sql->num_rows;

    $sql = $conn->query("SELECT SUM(userReview) AS total FROM rate");
    $data= $sql->fetch_array();
    $total = $data["total"];

    $avg = '';

    if($numR != 0) {
        if(is_nan(round( ($total / $numR),1))){
            $avg = 0;
        }
        else{
            $avg =round( ($total / $numR),1);
        }
    }
    else{
        $avg = 0;
    }
    

    $sql = $conn->query("SELECT COUNT(*) AS totalRatings FROM rate");
$data = $sql->fetch_assoc();
$totalRatings = $data['totalRatings'];

// Get count of each rating (1-5 stars)
$ratings = [];
for ($i = 1; $i <= 5; $i++) {
    $sql = $conn->query("SELECT COUNT(*) AS count FROM rate WHERE userReview = $i");
    $row = $sql->fetch_assoc();
    $ratings[$i] = $row['count'];
}

// Function to calculate percentage width
function getBarWidth($ratingCount, $totalRatings) {
    if ($totalRatings == 0) return 0; // Prevent division by zero
    return ($ratingCount / $totalRatings) * 100;
}
    
?>
<?php ?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
   <script src="main.js"></script>


 </head>
    <body>
    
            <div class="reviewcontainer">
           
                <div class="rating-review">
                
                    <div class="tri table-flex">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="rnb rvl">
                                            <h3><?php echo $avg;?>/5.0</h3>
                                        </div>
                                        <div class="pdt-rate">
                                            <div class="pro-rating">
                                                <div class="clearfix rating mart8">
                                                    <div class="rating-stars">
                                                        <div class="grey-stars"></div>
                                                            <div class="filled-stars" style="width:<?php echo $avg * 20; ?>%"></div>
                                                        </div></div>
                                                    </div>
                                                </div>

                                        <div class="rnrn">
                                            <p class="rars"><?php if($numR == 0) {echo "No";}else{echo $numR;} ?> Reviews</p>
                                        </div>
                                    </td>

                                        <td>
                                        <div class="rpb">
                                            <div class="rnpb">
                                                <label>5<i class="fa-regular fa-star"></i></label>
                                                <div class="ropb">
                                                    <div class="ripb" style="width:<?php echo getBarWidth($ratings[5], $totalRatings); ?>%;"></div>
                                                </div>
                                                <div class="label"></div>
                                            </div>
                                            <div class="rnpb">
                                                <label>4<i class="fa-regular fa-star"></i></label>
                                                <div class="ropb">
                                                    <div class="ripb" style="width:<?php echo getBarWidth($ratings[4], $totalRatings); ?>%;"></div>
                                                </div>
                                                <div class="label"></div>
                                            </div>
                                            <div class="rnpb">
                                                <label>3<i class="fa-regular fa-star"></i></label>
                                                <div class="ropb">
                                                    <div class="ripb" style="width:<?php echo getBarWidth($ratings[3], $totalRatings); ?>%;"></div>
                                                </div>
                                                <div class="label"></div>
                                            </div>
                                            <div class="rnpb">
                                                <label>2<i class="fa-regular fa-star"></i></label>
                                                <div class="ropb">
                                                    <div class="ripb" style="width:<?php echo getBarWidth($ratings[2], $totalRatings); ?>%;"></div>
                                                </div>
                                                <div class="label"></div>
                                            </div>
                                            <div class="rnpb">
                                                <label>1<i class="fa-regular fa-star"></i></label>
                                                <div class="ropb">
                                                    <div class="ripb" style="width:<?php echo getBarWidth($ratings[1], $totalRatings); ?>%;"></div>
                                                </div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        </td>

                                        <td>
                                            <div class="rrb">
                                                <button class="rbtn opmd">Add review</button>

                                            </div>
                                        </td>
                                  
                                </tr>
                            </tbody>
                        </table>


                        <div class="review-modal" style="display: none;">
                            <div class="review-bg"></div>
                            <div class="rmp">
                                <div class="rpc">
                                    <span><i class="fa-solid fa-xmark"></i></span>
                                </div>
                                <div class="rps" style="text-align:center">
                                <i class="fa-regular fa-star" data-index="0" style="display: none"></i>
                                <i class="fa-regular fa-star" data-index="1"></i>
                                <i class="fa-regular fa-star" data-index="2"></i>
                                <i class="fa-regular fa-star" data-index="3"></i>
                                <i class="fa-regular fa-star" data-index="4"></i>
                                <i class="fa-regular fa-star" data-index="5"></i>
                                </div>
                                <input type="hidden" value="" class="starRateV">
                                <input type="hidden" value="<?php  echo $date;?>" class="rateDate">
                                <div class="rptf" style="text-align:center">
                                    <input type="text" class="raterName" placeholder="Enter Your Name">
                                </div>
                                <div class="rptf"style="text-align:center">
                                    <textarea class="rateMsg" id="rate-field" placeholder="Review of the book"></textarea>
                                </div>
                                <div class="rate-error"style="text-align:center">
                                 <div class="rpsb"style="text-align:center">
                                    <button class="rpbtn" type="button">Post Review</button>
                                 </div>
                                 </div>
                            </div>
                         </div>  

 <div class="bri">
    <div class="uscm">
    <?php 
        $sqlp = "SELECT * FROM rate";
        $result = $conn->query($sqlp);
        if(mysqli_num_rows($result)>0){
            while($row = $result->fetch_assoc()){

           
    ?>
        <div class="uscm-secs">
            <div class="us-img">
                <p><?= substr($row['userName'], 0, 1);?></p>
            </div>
            <div class="uscms">
                <div class="us-rate">
                <div class="pdt-rate">
                 <div class="pro-rating">
                <div class="clearfix rating mart8">
                 <div class="rating-stars">
                <div class="grey-stars"></div>
                <div class="filled-stars" style="width:<?= $row['userReview'] * 20; ?>%"></div>
                </div></div>
                    </div>
                 </div>
                 </div>
                    <div class="us-cmt">
                        <p><?= $row['userMessage']; ?></p>
                    </div>
                    <div class="us-nm">
                        <p><i>By <span class="cmnm"><?= $row['userName']; ?></span> on <span class="cmdt"><?= $row['dateReviewed']; ?></span></i></p>
                    </div>
            </div>
        </div>
        <?php 
         }
        }
        ?>
    </div>
 </div>
 </div>
 </div>
            </div>




</body>
</html>

