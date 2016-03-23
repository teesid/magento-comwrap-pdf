<?php
require_once(Mage::getModuleDir('', 'Comwrap_Pdf') . '/lib/MPDF56/mpdf.php');

/**
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 *
 *
 * @license GPL 2.0
 * @package Comwrap/Pdf
 * @author Teesid Korsrilabutr <teesid@gmail.com>
 * @version 1.0
 */

/* An mPDF wrapper that provides the minimal subset of properties and methods
 * of Zend_Pdf so that it can work as a drop-in replacement in Magento.
 * Tested with Magento CE 1.9.2.3.
 */
class Comwrap_Pdf
{
    /*
     * @var array   - array of Comwrap_Pdf_Block_Abstract object
     */
    public $pages = array();

    /**
     * @var mPDF
     */
    protected $_pdf;

	/**
	 * @return $this
	 */
	public function __construct()
	{
		$this->_pdf = new mPDF('P', 'A4', '','', 5, 10, 5, 5);
		$this->_pdf->SetAutoFont();
		return $this;
	}


	public function render()
	{
        $lastPage = 0;
        foreach ($this->pages as $p) {
            if ($lastPage)
                $this->_pdf->AddPage();
		    $this->_pdf->writeHTML($p->render());
            $lastPage++;
        }
		return $this->_pdf->Output('', 'S');
	}
}
