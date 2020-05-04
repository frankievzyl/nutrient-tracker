<?php
    echo <<<"EP"
    <form name="edituserform" class="edit-user-form" method="get">
        <label for="firstname"></label>First Name<input id="firstname" type="text" name="FirstName" required>
        <label for="lastname"></label>Last Name<input id="lastname" type="text" name="LastName" required>
        <label for="email"></label>Email<input id="email" type="email" name="Email" required>
        <label for="emailconfirm">Confirm Email</label><input id="emailconfirm" type="email" name="EmailConfirm" required>
        <label for="password"></label>Password<input id="password" type="password" name="Password" required>
        <label for="passwordconfirm">Confirm Password</label><input id="passwordconfirm" type="password" name="PasswordConfirm" required>
        <label for="nutrientprofile">Nutrient Profile</label>
        <select id="nutrientprofile" name="nutrientprofile" required>
            <option value="1">0 - 6 months</option>
            <option value="2">6 - 12 months</option>
            <option value="3">Child 1 - 3 yrs</option>
            <option class="npA npf" value="4">Female 4 - 8 yrs</option>
            <option class="npA npm"value="5">Male 4 - 8 yrs</option>
            <option class="npB npf"value="6">Female 9 - 13 yrs</option>
            <option class="npB npm" value="7">Male 9 - 13 yrs</option>
            <option class="npC npf" value="8">Female 14 - 18 yrs</option>
            <option class="npC npp" value="9">Pregnant</option>
            <option class="npC npl" value="10">Lactation</option>
            <option class="npC npm" value="11">Male 14 - 18</option>
            <option class="npD npf" value="12">Female 19 - 30 yrs</option>
            <option class="npD npp" value="13">Pregnant</option>
            <option class="npD npl" value="14">Lactation</option>
            <option class="npD npm" value="15">Male 19 - 30 yrs</option>
            <option class="npE npf" value="16">Female 31 - 50 yrs</option>
            <option class="npE npp" value="17">Pregnant</option>
            <option class="npE npl" value="18">Lactation</option>
            <option class="npE npm" value="19">Male 31 - 50 yrs</option>
            <option class="npF npf" value="20">Female 51 - 70 yrs</option>
            <option class="npF npm" value="21">Male 51 - 70 yrs</option>
            <option class="npG npf" value="22">Female 70+ yrs</option>
            <option class="npG npm" value="23">Male 70+ yrs</option>
        </select>
        </label><input type="hidden" name="action" value="sign_up">
        </label><input type="hidden" name="controller" value="user">
        <button class="confirm-btn v-btn" type="submit">Sign-up</button>
        <button class="cancel-btn v-btn" type="button" onclick="hide_signup()">Cancel</button>
    </form>
EP;
?>