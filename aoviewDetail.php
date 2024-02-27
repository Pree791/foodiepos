<!-- Sales Details -->
<div>
        <table border=1>
                        <thead>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Purchase Quantity</th>
                            <th>Subtotal</th>
                        </thead>
                        <tbody>
                            <?php                            
                                $sql="select * from purchase_detail left join product on product.product_id=purchase_detail.productid where purchaseid='".$row['purchaseid']."'";
                                $dquery=$conn->query($sql);
                                while($drow=$dquery->fetch_array()){
                                    ?>
                                    <tr>
                                        <td class="text-right"><?php echo $drow['productname']; ?></td>
                                        <td class="text-right">&#8369; <?php echo number_format($drow['price'], 2); ?></td>
                                        <td class="text-right"><?php echo $drow['quantity']; ?></td>
                                        <td class="text-right">&#8369;
                                            <?php
                                                $subt = $drow['price']*$drow['quantity'];
                                                echo number_format($subt, 2);
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    
                                }
                            ?>
                            <tr>
                                <td colspan="3" class="text-right"><b>TOTAL</b></td>
                                <td class="text-right">&#8369; <?php echo number_format($row['total'], 2); ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            
            
