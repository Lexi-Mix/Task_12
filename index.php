<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task_12</title>
</head>

<body>
    <?php
    $example_persons_array = [
        [
            'fullname' => 'Иванов Иван Иванович',
            'job' => 'tester',
        ],
        [
            'fullname' => 'Степанова Наталья Степановна',
            'job' => 'frontend-developer',
        ],
        [
            'fullname' => 'Пащенко Владимир Александрович',
            'job' => 'analyst',
        ],
        [
            'fullname' => 'Громов Александр Иванович',
            'job' => 'fullstack-developer',
        ],
        [
            'fullname' => 'Славин Семён Сергеевич',
            'job' => 'analyst',
        ],
        [
            'fullname' => 'Цой Владимир Антонович',
            'job' => 'frontend-developer',
        ],
        [
            'fullname' => 'Быстрая Юлия Сергеевна',
            'job' => 'PR-manager',
        ],
        [
            'fullname' => 'Шматко Антонина Сергеевна',
            'job' => 'HR-manager',
        ],
        [
            'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
            'job' => 'analyst',
        ],
        [
            'fullname' => 'Бардо Жаклин Фёдоровна',
            'job' => 'android-developer',
        ],
        [
            'fullname' => 'Шварцнегер Арнольд Густавович',
            'job' => 'babysitter',
        ],
    ];

    function getFullnameFromParts($fname, $lname, $patron) //склеенное фио
    {
        return $fio_arr[] = $fname . ' ' . $lname . ' ' . $patron;
    };
    function getPartsFromFullname($stringFio) //разбито ФИО с ключами ‘name’, ‘surname’ и ‘patronomyc’.
    {
        return array_combine(array('surname', 'name', 'patronomyc'), explode(' ', $stringFio));
    };

    function getShortName($want_shot) // Сокращение ФИО
    {
        $want_shot_arr = getPartsFromFullname($want_shot);
        foreach ($want_shot_arr as $key => $value) {
            if ($key == 'surname') {
                $want_shot_arr[$key] = mb_substr($want_shot_arr[$key], 0, 1) . '.';
            };
            $fio_shot = $want_shot_arr['name'] . ' ' . $want_shot_arr['surname'];
            return $fio_shot;
        };
    };

    function getGenderFromName($gender_fio) // Определение пола
    {
        $gender = 0;
        $distr_fio = getPartsFromFullname($gender_fio);
        foreach ($distr_fio as $key => $value) {
            //Признаки женского пола
            $key == 'patronomyc' && mb_substr($value, -3) == 'вна' ? $gender-- : $gender;
            $key == 'name' && mb_substr($value, -1) == 'а' ? $gender-- : $gender;
            $key == 'surname' && mb_substr($value, -2) == 'ва' ? $gender-- : $gender;
            //Признаки мужского пола
            $key == 'patronomyc' && mb_substr($value, -2) == 'ич' ? $gender++ : $gender;
            $key == 'name' && mb_substr($value, -1) == 'й' || mb_substr($value, -1) == 'н' ? $gender++ : $gender;
            $key == 'surname' && mb_substr($value, -1) == 'в' ? $gender++ : $gender;
        };
        return $gender;
    };
    function getGenderDescription($genderDiscr) // определение полового состава аудитории
    {
        $man = 0;
        $woman = 0;
        $x = 0;
        foreach ($genderDiscr as $key => $value) {
            if ($genderDiscr[$key]['fullname']) {
                $new_arr[] = $genderDiscr[$key]['fullname'];
            };
            if (getGenderFromName($new_arr[$key]) == 0) $x++; //чётчик
            if (getGenderFromName($new_arr[$key]) > 0) $man++; //чётчик 
            if (getGenderFromName($new_arr[$key]) < 0) $woman++; //чётчик 
        };
        $length = count($new_arr);
        function prec($price, $value)
        {
            return round($result = ($value * 100) / $price);
        };
        function result($a, $b, $c)
        {
            echo "Гендерный состав аудитории:<br>";
            echo "---------------------------<br>";
            echo "Мужчины - {$a}%<br>";
            echo "Женщины - {$b}%<br>";
            echo "Не удалось определить - {$c}%";
        }
        return result(round(prec($length, $man)), round(prec($length, $woman)), round(prec($length, $x)));
    };
    function getPerfectPartner($fname, $lname, $patron, $perfectPartner_arr) // подбор идеальной пары
    {
        $str1 = mb_strtoupper(mb_substr($fname, 0, 1)). mb_strtolower(mb_substr($fname, 1));
        $str2 = mb_strtoupper(mb_substr($lname, 0, 1)). mb_strtolower(mb_substr($lname, 1));
        $str3 = mb_strtoupper(mb_substr($patron, 0, 1)). mb_strtolower(mb_substr($patron, 1));
        $fullname = getFullnameFromParts($str1, $str2, $str3);
        $gender = getGenderFromName($fullname);
        $randPerson = $perfectPartner_arr[rand(0,count($perfectPartner_arr)-1)]['fullname'];
        $gender_rand_person = getGenderFromName ($randPerson);
        function result2($name1, $name2) //вывод окончательной информации
        {
            $name1 = getShortName($name1);
            $name2 = getShortName($name2);
            $rand = rand(50, 100);
            echo "{$name1} + {$name2} = <br> Идеально на {$rand}%";
        };
        if ($gender > 0 && $gender_rand_person < 0) {
            result2($fullname,$randPerson);
        } elseif ($gender < 0 && $gender_rand_person > 0) {
            result2($fullname,$randPerson);
        } else echo "Не удалось найти вам пару, попробуйте ещё раз";
    };
    getPerfectPartner("Исаев", "Алексей", "Игоревич", $example_persons_array);
    ?>

</body>

</html>