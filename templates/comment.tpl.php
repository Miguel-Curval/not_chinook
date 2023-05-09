<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../database/comment.class.php');
  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawComment(Comment $comment, User $user, Session $session) { ?>
  <h2><?=$comment->content?>
    <?php if($session->isLoggedIn()) {?>
      <a href="../pages/edit_comment.php?id=<?=$comment->id?>"><i class="fa-solid fa-pen action"></i></a>
    <?php } ?>
  </h2>
  <h3><a href="../pages/user.php?id=<?=$user->id?>"><?=$user->username?></a></h3>      
  <table id="tracks">
    <p><?=$comment->content?></p>
  </table>
<?php } ?>

<?php function drawEditComment(Comment $comment) { ?>
  <form action="../actions/action_edit_comment.php" method="post">
    <input type="hidden" name="id" value="<?=$comment->id?>">
    <label>Content:</label>
    <input type="text" name="content" value="<?=$comment->content?>">
    <button type="submit">Save</button>
  </form>
<?php } ?>