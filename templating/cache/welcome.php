<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>

<body>
<h1>Welcome, <?php echo  $name ;?>!</h1>
    <p>You are <?php echo  $age ;?> years old.</p>

    <!-- Conditional Statements -->
    <?php if ($age > 50): ?>
        <p>You are eligible for the senior discount!</p>
    <?php else: ?>
        <p>You are not eligible for the senior discount.</p>
    <?php endif; ?>

    <!-- Variable Assignment -->
    <?php $greeting = "Hello"; ?>

    <p><?php echo  $greeting ;?>, <?php echo  $name ;?>! Here are your items:</p>

    <!-- Foreach Loop -->
    <h2>Your Items:</h2>
    <ul>
        <?php foreach ($items as $item): ?>
            <?php if ($item == 'Item 2'): ?>
                <?php /* This item is skipped */ ?>
                <?php continue; ?>
            <?php endif; ?>
            <li><?php echo  $item ;?></li>
        <?php endforeach; ?>
    </ul>

    <!-- Custom Function Call -->
    <p>Shouted Name: <?php echo custom_function($name); ?></p>

    <!-- Including a Partial Template -->
    <footer>
    Copyright &copy; 2024
</footer>
</body>

</html>