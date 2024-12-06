<div id="error-message"></div>
                
            <form id="frmPayment" action=""
                method="post"
                       >
                <div class="field-row">
                    <label>Card Number</label> <span
                        id="card-number-info" class="info"></span><br> <input
                        type="text" id="card-number" name="card-number"
                        class="demoInputBox">
                </div>
                <div class="field-row">
                    <div class="contact-row column-right">
                        <label>Expiry Month / Year</label> <span
                            id="userEmail-info" class="info"></span><br>
                        <select name="card_month" id="month"
                            class="demoSelectBox">
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select> <select name="card_year" id="year"
                            class="demoSelectBox">
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>
                    </div>
                </div>
                <div>
                    <input type="submit" name="pay_now" value="Submit"
                        id="submit-btn" class="btnAction">

                    <div id="loader">
                        <img alt="loader" src="LoaderIcon.gif">
                    </div>
                </div>
                <input type='hidden' name='total_amount' value='2'> 
            </form>
    <div class="test-data">
        <h3>Test Card Information</h3>
        <p>Use these test card numbers with valid expiration month
            / year for testing.</p>
        <table class="tutorial-table" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <th>CARD NUMBER</th>
                <th>BRAND</th>
            </tr>
            <tr>
                <td>4111111111111111</td>
                <td>Visa</td>
            </tr>
            
            <tr>
                <td>5424000000000015</td>
                <td>Mastercard</td>
            </tr>
            
            <tr>
                <td>370000000000002</td>
                <td>American Express</td>
            </tr>
            
            <tr>
                <td>6011000000000012</td>
                <td>Discover</td>
            </tr>
            
            <tr>
                <td>38000000000006</td>
                <td>Diners Club/ Carte Blanche</td>
            </tr>
            
            <tr>
                <td>3088000000000017</td>
                <td>JCB</td>
            </tr>
            
        </table>
    </div>
<input type="hidden" name="base_url" value="<?php echo base_url()?>">