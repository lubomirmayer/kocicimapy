<?php

namespace App\Presenters;

use App\Model\Cat;
use Nette\Application\Responses\JsonResponse;
use Nette\Bridges\ApplicationLatte\Template;
use Latte\Engine;
use Nette\Application\UI\Form;


class HomepagePresenter extends BasePresenter
{

        const
        FORM_MSG_REQUIRED = 'Tohle pole je povinné.';

        /**
        * @inject
        * @var \Kdyby\Doctrine\EntityManager
        */
       public $EntityManager;
    
	public function renderDefault()
	{
            
	}
        
        public function handleGetCats()
        {
            //just for ajax requests
            if (!$this->isAjax()) {exit;}
            
            $dao = $this->EntityManager->getRepository(Cat::getClassName());
            //\Tracy\Debugger::log($dao->findAll());
            $this->sendResponse(new JsonResponse($dao->findAll()));
            exit();
        }
        
        public function handleGetCatDetails()
        {
            //just for ajax requests
            if (!$this->isAjax()) {exit;}
            $id = $this->getParameter('catId');
            if ($id == null) {exit();}
            $dao = $this->EntityManager->getRepository(Cat::getClassName());
            $cat = $dao->find($id);
            //\Tracy\Debugger::log($dao->findAll());
            
            //TODO: get rid of this workaround
            $catHtmlString = "<H1>" . $cat->getName() . "</H1>";
            $catHtmlString .= "<p>" . $cat->getDescription() . "</p>";
            //TODO: extend db structure, add health states, colors, comments, photos
            
            //TODO: not able to load template file, fix in future
            //$latte = new Engine;
            //$template = new Template($latte);
            //$template->setFile('catDetail.phtml'); // specifikuje soubor se šablonou
            //$template->render(); // vykreslí šablonu 
            
            $this->sendResponse(new JsonResponse($catHtmlString));
            exit();
        }
        
            /**
            * Vrátí formulář pro pridani kocky.
            * @return Form formulář cat
            */
           protected function createComponentAddNewCatForm()
           {
               $form = new Form  ;
               $form->getElementPrototype()->class('ajax');
               $form->addText('catName', 'Jmeno:')
                   ->setAttribute('class', 'form-control')
                   ->setType('text')
                   ->setDefaultValue('')
                   ->setRequired(self::FORM_MSG_REQUIRED)
                   ->addRule(Form::FILLED, self::FORM_MSG_REQUIRED);
               $form->addText('catAge', 'Věk v měsících:')
                   ->setAttribute('class', 'form-control')
                   ->setType('number')
                   ->setDefaultValue('')
                   ->setRequired(self::FORM_MSG_REQUIRED)
                   ->addRule(Form::FILLED, self::FORM_MSG_REQUIRED);
               $form->addTextArea('catDescription', 'Popis:')
                   ->setAttribute('class', 'form-control')    
                   ->setDefaultValue('');
               $form->addHidden('catLat')->setAttribute('id', 'catLat');
               $form->addHidden('catLng')->setAttribute('id', 'catLng');;
               $form->addSubmit('addCat', 'Dokonči')->setDisabled()
                    ->setAttribute('class', 'form-control')->setAttribute('id','catFormSubmit');
               $form->onSuccess[] = [$this, 'catFormSucceeded'];
               return $form;
            }

        public function catFormSucceeded($form, $values)
        {
            $cat = new Cat();
            $cat->setName($values->catName);
            $cat->setAge($values->catAge);
            $cat->setDescription($values->catDescription);
            $cat->setLat($values->catLat);
            $cat->setLng($values->catLng);
            
            $this->EntityManager->persist($cat);
            $this->EntityManager->flush();

            //if (!$this->isAjax())
                $this->redirect('this');
            //else {
            //    $this->sendResponse(new JsonResponse($cat));
            //}
            //exit();
        }
}
