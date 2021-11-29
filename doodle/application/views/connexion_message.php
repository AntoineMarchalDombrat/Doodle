<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div>
         <h2> Connexion </h2>
         <br><br><br>
         <form method="POST">
            <table>

            <tr>
               <td>
                  <label> Login : </label>
               </td>
               <td>
                  <input type="text" placeholder="Votre login" name="login" maxlength="20">
               </td>
            </tr>

            <tr>
               <td>
                  <label> Mot de passe : </label>
               </td>
               <td>
                  <input type="password" placeholder="Votre mdp" name="mdp" maxlength="200">
               </td>
            </tr>
            <tr>
              <td></td>
            	<td>
            		<br>
            	<input type="submit" value="je me connecte">
        		  </td>
        	  </tr>
            </table>
         </form>
      </div>

</body>
</html>
