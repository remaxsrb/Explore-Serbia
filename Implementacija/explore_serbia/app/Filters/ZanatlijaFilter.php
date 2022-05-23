<?php
// by Marko Jovanovic 2018/0607
// by Miloš Brković 0599/2019

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ZanatlijaFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session=session();
        if ($session->has("korisnik")){
            if ($session->get("korisnik")->tip == 1){
                return redirect()->to(site_url("Admin"));
            } else if ($session->get("korisnik")->tip == 2){
                return redirect()->to(site_url("Pisac"));
            } 
        } else {
            return redirect()->to(site_url("Gost"));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}