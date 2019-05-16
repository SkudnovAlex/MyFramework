<?php


namespace ishop;

/** класс работы с кешем
 * Class Cache
 * @package ishop
 */
class Cache
{
    use TSingleton;

    /** установка кеша
     * @param $key
     * @param $data
     * @param int $seconds
     * @return bool
     */
    public function setCache($key, $data, $seconds = 3600)
    {
        if ($seconds) {
            $content['data'] = $data;
            $content['end_time'] = time() + $seconds;

            if (file_put_contents(CACHE . '/' . md5($key) . '.txt', serialize($content))) {
                return true;
            }
        }

        return false;
    }

    /** получение кеша
     * @param $key
     * @return bool
     */
    public function getCache($key)
    {
        $file = CACHE . '/' . md5($key) . '.txt';

        if (file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if (time() <= $content['end_time']) {
                return $content['data'];
            }
            unlink($file);
        }

        return false;
    }

    /** удаление кеша
     * @param $key
     * @return mixed
     */
    public function deleteCache($key)
    {
        $file = CACHE . '/' . md5($key) . '.txt';

        if (file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if (time() <= $content['end_time']) {
                return $content;
            }
            unlink($file);
        }
    }
}