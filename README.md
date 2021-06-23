# [PVE-VDI-Gateway](https://github.com/DJHongKong/PVE-VDI-Gateway)
### 安装环境
* PHP >=5.4.16
* Nginx >= 1.18

###安装
1. 将所有文件复制到web目录
2. 修改Login.php账号密码及PVE节点IP
3. 修改admin/login.php管理员账号及密码
4. 赋予web目录权限777
5. 访问web自动安装

###客户端连接
1. 安装[virt-viewer](https://virt-manager.org/download/sources/virt-viewer/virt-viewer-x64-10.0-1.0.msi)
2. 访问IP:端口/admin
3. 登录并添加用户
4. 访问IP:端口/index.html
* 推荐使用火狐浏览器kiosk模式作为客户端

###### Code By HongKong