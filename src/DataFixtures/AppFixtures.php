<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use App\Entity\Question;
use App\Factory\QuestionFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        QuestionFactory::createMany(20);

        QuestionFactory::new()
            ->unpublished()
            ->many(5)
            ->create()
        ;

        $answer = new Answer();
        $answer->setContent('This is the answer content.');
        $answer->setUsername('jdevine');

        $question = new Question();
        $question->setQuestion('I don\'t know what to do!');
        $question->setName('I\m Lost');

        $answer->setQuestion($question);

        $manager->persist($answer);
        $manager->persist($question);

        $manager->flush();
    }
}
