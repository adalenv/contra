 <script type="text/javascript">
    $(function(){   
        $(document).keydown(function(objEvent) {        
            if (objEvent.ctrlKey) {          
                if (objEvent.keyCode == 65 || objEvent.keyCode == 97) {                         

                    return false;
                }            
            }        
        });
    });   
</script>
<footer class="footer">
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a style="margin-right:15px" href="#">Adalen VLADI</a> <!-- , made with love for a better web -->
                    </p>
                </div>
                <!-- start o_chat code
<link  href="http://<?=$_SERVER['HTTP_HOST'];?>:333/o_chatcss.php?me=<?=$_SESSION['user_id'];?>&role=<?=$_SESSION['role'];?>" media="all" rel="stylesheet" />
<script src="http://<?=$_SERVER['HTTP_HOST'];?>:333/o_chatjs.php?me=<?=$_SESSION['user_id'];?>&role=<?=$_SESSION['role'];?>" type="text/javascript"  type="text/css" ></script>
 end o_chat code -->
            </footer>
        </div>
    </div>
</body>
</html>
