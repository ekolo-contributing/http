<?php
    /**
     * Ce fichier est une partie du Framework Ekolo
     * (c) Don de Dieu BOLENGE <dondedieubolenge@gmail.com>
     */
    namespace Ekolo\Component\Http\Options;
    
    use Ekolo\Component\EkoMagic\ParameterBag;

    /**
     * Controlle les paramètres de $_POST (Les données venant d'un formulaire par la méthode POST)
     */
    class Bodies extends ParameterBag {

        public function __construct(array $vars = [])
        {
            parse_str(file_get_contents('php://input'), $_POST);
            $_POST = !empty($vars) ? array_merge($_POST, $vars) : $_POST;
            parent::__construct($_POST);
        }

        /**
         * Permet de modifier la valeur de GET
         * @param string $key La clé
         * @param mixed $value la valeur
         * @return void
         */
        public function set($key, $value)
        {
            parent::set($key, $value);
            $_POST[$key] = $value;
        }

        /**
         * Permet d'ajouter un nouveau tableau de GET
         * @param array $parameters Les paramètres à ajouter
         * @return void
         */
        public function add(array $parameters = [])
        {
            parent::add($parameters);
            $_POST = array_merge($_POST, $parameters);
        }

        /**
         * Remplace les variables GET
         * @param array $parameters
         * @return void
         */
        public function replace(array $parameters = [])
        {
            parent::replace($parameters);
            $_POST = $parameters;
        }

        /**
         * Supprime la variable
         * @param string $key La clé de la variable à supprimer
         * @return void
         */
        public function remove($key)
        {
            parent::remove($key);
            unset($_POST[$key]);
        }

        /**
         * Retourne la variable dont la clé passée en paramètre
         * @param string $key La clé de la variable à retoruner
         * @return void
         */
        public function get($key, $default = null)
        {
            parent::get($key, $default);

            return $this->has($key) ? $_POST[$key] : null;
        }

        /**
         * Retourne les variables
         * @return array
         */
        public function all()
        {
            parent::all();

            return $_POST;
        }

        /**
         * Renvoi les clés des paramètres
         * @return array
         */
        public function keys()
        {
            parent::keys();
            return array_keys($_POST);
        }

        /**
         * Vérifie si le parameter existe
         * @param string $key
         * @return bool
         */
        public function has($key)
        {
            parent::has($key);
            return array_key_exists($key, $_POST);
        }

        /**
         * Retourne Le nombre de parameters
         * @return int
         */
        public function count()
        {
            parent::count();
            return \count($_POST);
        }
    }