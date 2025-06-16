import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  
};

module.exports = {
  images: {
    remotePatterns: [
      {
        protocol: "https",
        hostname: "placehold.co",
        port: "",
        pathname: "/**",
      },
    ]
  }
}

export default nextConfig;
