<?php

namespace App\Http\Controllers;

use App\Interfaces\ShortUrlInterface;
use Illuminate\Http\Request;

class ShorterController extends Controller
{
    protected $_shortUrlRepository;

    function __construct(ShortUrlInterface $shortUrlInterface) {
        $this->_shortUrlRepository = $shortUrlInterface;
    }

    /**
     * From a shortned url previously generated it redirect to the original url
     *
     * @param string $url
     * @return redirection
     */
    public function redirection($url) {
        $checked_url = $this->_shortUrlRepository->checkRedirection($url);
        return redirect($checked_url);
    }

    /**
     * Return the complete list of generated shortened url
     *
     * @return array $generated
     */
    public function index() {
        return response()->json($this->_shortUrlRepository->getAllUrl());
    }

    /**
     * Create a shortened url from url passed in body request
     *
     * @param Request $request
     * @return string $generated
     */
    public function create(Request $request) {
        $this->validate($request, [
            'long_url' => 'required'
        ]);

        $long       = $request->input('long_url');
        $generated  = $this->_shortUrlRepository->createNewUrl($long);

        if($generated == false) {
            $generated = 'Url already exist';
        }

        return response($generated);
    }

    /**
     * Delete url previously generated form ID passed in body request
     *
     * @param Request $request
     * @return $string response
     */
    public function delete(Request $request) {
        $this->validate($request, [
            'id' => 'required|int'
        ]);

        $id = $request->input('id');
        $this->_shortUrlRepository->deleteUrl($id);

        return response()->json("Url deleted successfully");
    }

    /**
     * Return a global redirection count
     *
     * @return int $counter
     */
    public function allCount() {
        $counter = $this->_shortUrlRepository->getAllRedirection();
        return response()->json($counter);
    }

    /**
     * Return the redirection count of a specific url id passed
     *
     * @param int $id
     * @return int $counter
     */
    public function singleCount($id) {
        $counter = $this->_shortUrlRepository->getSingleRedirection($id);
        return response()->json($counter);

    }
}
