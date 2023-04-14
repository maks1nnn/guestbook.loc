<?php

namespace classes;


class Pagination
{

    public int $countPages;
    public int $currentPage ;
    public string $uri ;
    public int $perpage; 
    public int $total ;

    public function __construct( $page, $perpage, $total  )
    {
        $this->total = $total;
        $this->perpage = $perpage;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
        
        
    }

    public function get_start(): int
    {
        return ($this->currentPage - 1) * $this->perpage;
    }

    public function getCountPages(): int
    {
        return ceil($this->total / $this->perpage) ?: 1;
    }

    public function getCurrentPage($page): int
    {
        if (!$page || $page < 1) $page = 1;
        
        if ($page > $this->countPages) $page = $this->countPages;
        
        return $page;
    }

    public function getParams(): string
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0];
        if (isset($url[1]) && $url[1] != '') {
            $uri .= '?';
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                if (!preg_match("#page=#", $param)) $uri .= "{$param}&amp;";
            }
        }
        return $uri;
    }

    public function getHtml(): string
    {
        $back = null;
        $forward = null;
        $startPage = null;
        $endPage = null;
        $page1Left = null;
        $page2Left = null;
        $page1Right = null;        
        $page2Right = null;

        if ($this->currentPage > 1) {
            $back = "<li><a class='nav-link' href='{$this->uri}page =" . 
            ($this->currentPage - 1) . "'>&lt;</a></li>";
        }

        if ($this->currentPage < $this->countPages) {
            $forward = "<li><a class='nav-link' href='{$this->uri}page =" . 
            $this->get_link($this->currentPage + 1) . "'>&gt;</a></li>";
        }

        if ($this->currentPage > 3) {
            $startPage = "<li><a class='nav-link' href='{$this->uri}page =1'>&laquo;</a></li>";
        }

        if ($this->currentPage < ($this->countPages - 2)) {
            $endPage = "<li><a class='nav-link' href='{$this->uri}page ={$this->countPages}'>&laquo;</a></li>";
        }

        if ($this->currentPage - 2 > 0) {
            $page2Left = "<li><a class='nav-link' href='{$this->uri}page =" . ($this->currentPage - 2) . "'>" . ($this->currentPage - 2) ."</a></li>";
        }


        if ($this->currentPage - 1 > 0) {
            $page1Left = "<li><a class='nav-link' href='{$this->uri}page =" . ($this->currentPage - 1) . "'>" . ($this->currentPage - 1) ."</a></li>";
        }

        
        if ($this->currentPage + 1 <= $this->countPages) {
            $page1Right = "<li><a class='nav-link' href='{$this->uri}page =" . ($this->currentPage + 1) . "'>" . ($this->currentPage + 1) ."</a></li>";
        }
        

        
            if ($this->currentPage + 2 <= $this->countPages) {
                $page2Right = "<li><a class='nav-link' href='{$this->uri}page =" . ($this->currentPage + 2) . "'>" . ($this->currentPage +2) ."</a></li>";
            }
    
        

        return '<ul class="pagination">' . $startPage . $back . $page2Left . 
        '<li class=" active"><a>'  . $this->currentPage . '</a></li>' . $page1Right . $page2Right . $forward . $endPage . '</ul>';

    }

    public function get_link($page): string
    {
        if ($page == 1) {
            return rtrim($this->uri, '?&');
        }

        if (str_contains($this->uri, '&')) {
            return "{$this->uri}page={$page}";
        } else {
            if (str_contains($this->uri, '?')) {
                return "{$this->uri}page={$page}";
            } else {
                return "{$this->uri}?page={$page}";
            }
        }
    }

    public function __toString(): string
    {
        return $this->getHtml();
    }

}